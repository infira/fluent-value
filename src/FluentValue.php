<?php

namespace Infira\FluentValue;

use Closure;
use Infira\FluentValue\Processors\FluentValueProcessor;
use Infira\FluentValue\Processors\LaravelStringableProcessor;
use Infira\FluentValue\Processors\Processor;
use Wolo\AttributesBag;

/**
 * @template TValue
 * @mixin LaravelStringableProcessor
 * @property-read $this $mutate - enables mutator, every chain call will alter original value, mutator will turn off after first chain call
 * @property-read FluentChain $chain
 * @property-read FluentChain $whenOk
 * @property-read mixed $value - Get the underlying value
 */
class FluentValue implements
    \ArrayAccess,
    \Countable,
    \Stringable,
    AttributesBag\HasAttributes
{
    public const UNDEFINED = '_UNDEFINED_';
    use AttributesBag\AttributesBagManager;
    use Processors\Traits\Comparing;
    use Traits\Helpers,
        Traits\FluentImmutableValue;


    private bool $mutatorEnabled = false;
    private bool $endMutationManually = false;
    private FluentValueProcessor $proc;

    public function __construct(mixed $value)
    {
        $this->proc = new FluentValueProcessor($value);
        $this->init();
    }

    /**
     * Will be called right after __construct
     *
     * @return void
     */
    public function init(): void {}

    /**
     * @return Processor[]
     */
    public function getProcessors(): array
    {
        return [
            LaravelStringableProcessor::class
        ];
    }

    /**
     * Convert to real value
     *
     * @param  mixed  $value
     * @return mixed
     */
    protected function pv(mixed $value): mixed
    {
        if ($value instanceof self) {
            $value = $value->get();
        }
        elseif ($value instanceof Closure) {
            //$value = \Wolo\Closure::makeInjectableOrVoid($value)($this);
            $value = \Wolo\Closure::makeInjectableOrVoid($value)($this->get());
        }

        if ($value instanceof self) {
            $value = $value->get();
        }

        return $value;
    }

    /**
     * Set value for this instance
     *
     * @param  mixed  $value
     * @return $this
     */
    public function set(mixed $value): static
    {
        $this->proc->setValue($this->pv($value));

        return $this;
    }

    public function setAt(string|int $key, mixed $value): static
    {
        $this->offsetSet($key, $value);

        return $this;
    }

    /**
     * Edit value with callable
     * Closure callable is injectable ex ->edit(\MyClass $value) // will call $editor(MyClass(TValue))
     *
     * @param  (callable(TValue): mixed)  $editor
     * @return $this
     */
    public function edit(callable $editor): static
    {
        $this->proc->setValue($editor);

        return $this;
    }

    /**
     * Get the underlying value
     *
     * @return mixed
     * @alias
     * @see self::getValue()
     */
    public function get(): mixed
    {
        return $this->proc->getValue();
    }

    /**
     * Get the underlying value
     *
     * @return mixed
     * @alias
     * @see self::getValue()
     */
    public function value(): mixed
    {
        return $this->get();
    }

    public function new(mixed $value = null): static
    {
        $hasArgs = func_num_args() > 0;
        if ($this->mutatorEnabled) {
            if ($hasArgs) {
                $this->set($value);
            }
            if (!$this->endMutationManually) {
                $this->mutatorEnabled = false;
            }

            return $this;
        }
        $constructValue = $hasArgs ? $this->pv($value) : $this->get();

        return (new static($constructValue))->setAttributes($this->getAttributes());
    }

    public static function make(mixed $value): static
    {
        return new static($value);
    }

    //region mutation

    public function mutate(bool $endMutationManually = false): static
    {
        $this->endMutationManually = $endMutationManually;
        $this->mutatorEnabled = true;

        return $this;
    }

    public function endMutation(): static
    {
        $this->mutatorEnabled = false;
        $this->endMutationManually = false;

        return $this;
    }
    //endregion

    //region magic
    public function __invoke(callable $parser = null)
    {
        if ($parser === null) {
            return $this->get();
        }

        return $this->new($parser)->get();
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function __get(string $name)
    {
        if ($name === 'value') {
            return $this->proc->getValue();
        }

        if ($name === 'mutate') {
            return $this->mutate(false);
        }

        if ($name === 'chain') {
            return $this->chain($this);
        }
        if ($name === 'whenOk') {
            return $this->whenOkChain();
        }

        if ($this->proc->propertyExists($name)) {
            $value = $this->proc->getPropertyValue($name);

            return $this->getProcessorOutput($this->proc, $value);
        }

        //FluentValueProcessor doesn't have necessary properties, lets fund out that other processors has
        foreach ($this->getProcessors() as $processor) {
            $processor = new $processor($this->get());
            if ($processor->propertyExists($name)) {
                $value = $processor->getPropertyValue($name);

                return $this->getProcessorOutput($processor, $value);
            }
        }
        throw new \InvalidArgumentException("property|method('$name') does not exist");
    }

    public function __set(string $name, $value): void
    {
        if ($name === 'value') {
            $this->set($value);
        }

        if ($this->canOffset()) {
            $this->proc->offsetSet($name, $value);

            return;
        }
        throw new \RuntimeException('cant set value');
    }

    public function __isset(string $name): bool
    {
        if ($this->canOffset()) {
            return $this->offsetExists($name);
        }
        throw new \RuntimeException('cant use __isset');
    }

    public function __call(string $method, array $arguments = []): static|bool|null
    {
        if ($arguments) {
            $arguments = array_map(
                static function ($v) {
                    if ($v instanceof self) {
                        return $v->get();
                    }

                    return $v;
                },
                $arguments
            );
        }

        if ($this->proc->canExecute($method)) {
            $value = $this->proc->execute($method, ...$arguments);

            return $this->getProcessorOutput($this->proc, $value);
        }

        //FluentValueProcessor doesn't have necessary methods, lets fund out that other processors has
        foreach ($this->getProcessors() as $processor) {
            $processor = $processor instanceof Processor ? $processor : new $processor($this->get());
            if ($processor->canExecute($method)) {
                $value = $processor->execute($method, ...$arguments);

                return $this->getProcessorOutput($processor, $value);
            }
        }
        throw new \InvalidArgumentException("method('$method') does not exist");
    }

    //endregion

    private function getProcessorOutput(Processor $processor, $value): mixed
    {
        if ($processor->canConvertToFluent($value)) {
            return $this->new($processor->getFluentValue($value));
        }

        return $value;
    }

    /**
     * Get default value added tax
     *
     * @return float|int
     */
    public static function getDefaultVATPercent(): float|int
    {
        return 20;
    }


    /**
     * Get default date format for flu()->formatDate()
     */
    public static function getDefaultDateFormat(): string
    {
        return 'd.m.Y';
    }

    /**
     * Get default date format for flu()->formatDate()
     */
    public static function getDefaultDateTimeFormat(): string
    {
        return 'd.m.Y H:i:s';
    }

    //region PHP built interface implementations
    public function offsetExists(mixed $offset): bool
    {
        return $this->proc->offsetExists($offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->proc->offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->proc->offsetSet($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->proc->offsetUnset($offset);
    }

    public function count(): int
    {
        return $this->proc->count();
    }
}
