<?php

namespace Infira\FluentValue;

use Closure;
use Illuminate\Support\Stringable;
use Stringable as BaseStringable;
use Wolo\AttributesBag;

/**
 * @template TValue
 * @mixin Stringable
 * @property-read $this $mutate - enables mutator, every chain call will alter original value, mutator will turn off after first chain call
 * @property-read FluentChain $chain
 * @property-read FluentChain $whenOk
 */
class FluentValue implements
    \ArrayAccess,
    \Countable,
    BaseStringable,
    AttributesBag\HasAttributes
{
    public const UNDEFINED = '_UNDEFINED_';
    use AttributesBag\AttributesBagManager;
    use Traits\PHPBuiltInterfaceImplementations,
        Traits\Miscellaneous,
        Traits\Hashing,
        Traits\Numbers,
        Traits\MoneyAndTaxes,
        Traits\Comparing,
        Traits\Dates,
        Traits\Strings,
        Traits\HtmlManipulation,
        Traits\Arrays,
        Traits\Files,
        Traits\ConditionMutators;

    /** @generated */
    use Traits\CastingMutators;

    /**
     * @var callable
     */
    private $templateProcessor;
    private bool $mutatorEnabled = false;
    private bool $endMutationManually = false;
    public mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $this->pv($value);
        $this->init();
    }

    /**
     * Will be called right after __construct
     * @return void
     */
    public function init(): void {}

    public function stringable(): Stringable
    {
        return new (Flu::$stringableProcessor)($this->value);
    }

    private function methodExists(string $method): bool
    {
        if (method_exists($this, $method)) {
            return true;
        }

        return method_exists(Stringable::class, $method);
    }

    /**
     * Convert to real value
     * @param  mixed  $value
     * @return mixed
     */
    protected function pv(mixed $value): mixed
    {
        if ($value instanceof self) {
            $value = $value->value;
        }
        elseif ($value instanceof Closure) {
            //$value = \Wolo\Closure::makeInjectableOrVoid($value)($this);
            $value = \Wolo\Closure::makeInjectableOrVoid($value)($this->value);
        }
        elseif ($value instanceof Stringable) {
            $value = (string)$value;
        }

        return $this->fluValue($value);
    }

    protected function fluValue(mixed $value): mixed
    {
        return $value instanceof self ? $value->value : $value;
    }

    protected function numericValue(mixed $value): float|int
    {
        return Flu::numeric($this->pv($value));
    }

    /**
     * Set value for this instance
     * @param  mixed  $value
     * @return $this
     */
    public function set(mixed $value): static
    {
        $this->value = $this->pv($value);

        return $this;
    }

    /**
     * Edit value with callable
     * Closure callable is injectable ex ->edit(\MyClass $value) // will call $editor(MyClass(TValue))
     * @param  (callable(TValue): mixed)  $editor
     * @return $this
     */
    public function edit(callable $editor): static
    {
        $this->value = $this->pv($editor);

        return $this;
    }

    /**
     * Get the underlying value
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->value;
    }

    /**
     * Get the underlying value
     * @return mixed
     */
    public function value(): mixed
    {
        return $this->value;
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
        $constructValue = $hasArgs ? $this->pv($value) : $this->value;

        return (new static($constructValue))->setAttributes($this->getAttributes());
    }

    public static function make(mixed $value): static
    {
        return new static($value);
    }


    //region mutation
    public function chain(self $carry = null): FluentChain
    {
        return new FluentChain($carry ?: $this);
    }

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
    public function __invoke(mixed $value = null)
    {
        if ($value === null) {
            return $this->value;
        }

        return $this->new($value)->value;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function __get(string $name)
    {
        if ($name === 'mutate') {
            return $this->mutate(false);
        }

        if ($name === 'chain') {
            return $this->chain($this);
        }
        if ($name === 'whenOk') {
            return $this->whenOkChain();
        }

        if (!$this->methodExists($name)) {
            throw new \InvalidArgumentException("method('$name') does not exist");
        }

        return $this->$name();
    }

    public function __call(string $name, array $arguments): static|bool|null
    {
        if (!$this->methodExists($name)) {
            throw new \InvalidArgumentException("method('$name') does not exist");
        }
        $result = $this->stringable()->$name(
            ...array_map(static function ($v) {
                if ($v instanceof self) {
                    return $v->get();
                }

                return $v;
            }, $arguments)
        );
        if (is_bool($result)) {
            return $result;
        }
        if ($result instanceof Stringable) {
            $result = (string)$result;
        }

        return $this->new($result);
    }

    //endregion
}
