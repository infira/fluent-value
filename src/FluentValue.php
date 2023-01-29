<?php

namespace Infira\FluentValue;

use Closure;
use Infira\FluentValue\Chain\Editor;
use Infira\FluentValue\Chain\FluentChain;
use Infira\FluentValue\Contracts\Processor;
use Infira\FluentValue\Facade\Callables;
use Infira\FluentValue\Processors\FluentValueProcessor;
use Infira\FluentValue\Processors\LaravelStringableProcessor;
use Infira\FluentValue\Traits\FluentImmutableValue;
use Traversable;
use Wolo\AttributesBag;
use Wolo\Contracts\UnderlyingValue;
use Wolo\Contracts\UnderlyingValueStatus;

/**
 * @template TValue
 * @mixin LaravelStringableProcessor
 * @property-read Editor $edit - enables editor, every chain call will alter original value, editor will turn off after first chain call
 * @property-read FluentValueProcessor $to - returns FluentValueProcessor
 * @property-read FluentChain $chain
 * @property-read FluentChain $whenOk
 * @property-read FluentChain $map
 * @property-read mixed $value - Get the underlying value
 */
class FluentValue implements
    \ArrayAccess,
    \Countable,
    \Stringable,
    \JsonSerializable,
    \IteratorAggregate,
    UnderlyingValue,
    UnderlyingValueStatus,
    AttributesBag\HasAttributes
{
    public const UNDEFINED = '_UNDEFINED_';
    /**
     * @var class-string
     */
    public static $valueProcessor = FluentValueProcessor::class;

    use AttributesBag\AttributesBagManager;
    use Processors\Traits\Finals;
    use Traits\Helpers,
        Traits\FluentImmutableValue;


    private FluentValueProcessor $proc;
    private array $events = [
        'change' => []
    ];

    public function __construct(mixed $value)
    {
        $this->proc = $this->createProcessor($value);
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
            $value = Callables::makeInjectable($value)($this->value());
        }

        if ($value instanceof self) {
            $value = $value->get();
        }

        return $value;
    }

    /**
     * Set value for this instance, $value will be processed
     *
     * @param  mixed  $value
     * @return $this
     */
    public function set(mixed $value): static
    {
        $this->setValue($this->pv($value));

        return $this;
    }

    /**
     * Set real underlying value
     *
     * @param  mixed  $value
     * @return $this
     */
    public function setValue(mixed $value): static
    {
        $this->proc->setValue($value);
        $this->trigger('change');

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
        $this->setValue($this->pv($editor));

        return $this;
    }

    /**
     * Get the underlying value
     *
     * @return mixed
     * @alias
     */
    public function get(): mixed
    {
        return $this->proc->value();
    }

    /**
     * Get the underlying value
     *
     * @return mixed
     * @alias
     */
    public function value()
    {
        return $this->proc->value();
    }

    public function new(mixed $value = null): static
    {
        return static::make(func_num_args() > 0 ? $this->pv($value) : $this->value())
            ->withAttributes($this->getAttributes())
            ->withEvents($this->getEvents());
    }

    public function withAttributes(array $attributes): static
    {
        $this->setAttributes($attributes);

        return $this;
    }

    public static function make(mixed $value): static
    {
        return new static($value);
    }

    //region editor

    /**
     * enables editor, every chain call will alter original value, editor will turn off after first chain call
     *
     * @param  bool  $endManually  - mutatoion chain will be ended after ->end() call
     * @return Editor
     */
    public function editor(bool $endManually = false): Editor
    {
        return new Editor($this, $endManually);
    }

    //endregion

    //region events
    public function onChange(callable $callback): static
    {
        return $this->on('change', $callback);
    }

    public function on(string $event, callable $callback): static
    {
        $this->events[$event][] = $callback;

        return $this;
    }

    public function trigger(string $event): void
    {
        foreach ($this->events[$event] as $callback) {
            $callback($this->value());
        }
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function withEvents(array $events): static
    {
        $this->events = $events;

        return $this;
    }
    //endregion


    //region magic
    public function __invoke(callable $parser = null)
    {
        if ($parser === null) {
            return $this->value();
        }

        return $this->new($parser)->get();
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function __get(string $name)
    {
        $namedOutput = match ($name) {
            'value' => $this->value(),
            'to' => $this->createProcessor($this->value()),
            'edit' => $this->editor(false), //TODO kas seda on tegelt vaja?
            'chain' => $this->chain($this),
            'whenOk' => $this->whenOkChain(),
            'map' => $this->mapChain(),
            default => self::UNDEFINED
        };
        if ($namedOutput !== self::UNDEFINED) {
            return $namedOutput;
        }


        if (method_exists(FluentImmutableValue::class, $name)) {
            return $this->{$name}();
        }

        if ($this->proc->propertyExists($name)) {
            $value = $this->proc->getPropertyValue($name);

            return $this->getProcessorOutput($this->proc, $value);
        }

        //FluentValueProcessor doesn't have necessary properties, lets fund out that other processors has
        foreach ($this->getProcessors() as $processor) {
            $processor = new $processor($this->value());
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

            return;
        }
        throw new \RuntimeException('Undefined usage for __set');
    }

    public function __isset(string $name): bool
    {
        if ($name === 'value') {
            return !$this->isEmpty();
        }
        throw new \RuntimeException('Undefined usage for __isset');
    }

    public function __call(string $method, array $arguments = []): static|bool|null
    {
        return $this->getProcessorOutput(...$this->callProcessors($method, $arguments));
    }

    public function callProcessors(string $method, array $arguments = []): array
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
            return [$this->proc, $this->proc->execute($method, ...$arguments)];
        }

        //FluentValueProcessor doesn't have necessary methods, lets fund out that other processors has
        foreach ($this->getProcessors() as $processor) {
            $processor = $processor instanceof Processor ? $processor : new $processor($this->value());
            if ($processor->canExecute($method)) {
                return [$processor, $processor->execute($method, ...$arguments)];
            }
        }
        throw new \InvalidArgumentException("method('$method') does not exist");
    }

    public function execute(string|array $method, mixed ...$param): mixed
    {
        $carry = $this;
        foreach ((array)$method as $m) {
            $carry = $carry->$m(...$param);
        }

        return $carry;
    }

    //endregion

    private function createProcessor(mixed $value): FluentValueProcessor
    {
        $value = $value instanceof self ? $value->value() : $value;
        $value = $value instanceof \Stringable ? (string)$value : $value;
        $proc = new static::$valueProcessor($value);
        if (!($proc instanceof FluentValueProcessor)) {
            throw new \RuntimeException('Processor must be instance of \Infira\FluentValue\Processors\FluentValueProcessor');
        }

        return $proc;
    }

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
        $this->setValue(Flu::setAt($offset, $this->value(), $value));
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->setValue(Flu::removeAt($offset, $this->value()));
    }

    public function count(): int
    {
        return $this->proc->size();
    }
    //endregion
}
