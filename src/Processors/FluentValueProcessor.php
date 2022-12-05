<?php

namespace Infira\FluentValue\Processors;

use Illuminate\Support\Stringable;
use Infira\FluentValue\FluentChain;
use Infira\FluentValue\FluentValue;
use Stringable as BaseStringable;

/**
 * @template TValue
 * @mixin Stringable
 * @property-read $this $mutate - enables mutator, every chain call will alter original value, mutator will turn off after first chain call
 * @property-read FluentChain $chain
 * @property-read FluentChain $whenOk
 * @property-read FluentValue $flu
 */
class FluentValueProcessor implements
    \ArrayAccess,
    \Countable,
    BaseStringable,
    Processor
{
    public const UNDEFINED = '_UNDEFINED_';
    use \Infira\FluentValue\Traits\Helpers;
    use
        Traits\Miscellaneous,
        Traits\Hashing,
        Traits\Numbers,
        Traits\MoneyAndTaxes,
        Traits\Dates,
        Traits\Strings,
        Traits\Comparing,
        Traits\HtmlManipulation,
        Traits\Arrays,
        Traits\Files,
        Traits\Casting,
        Traits\Conditions;

    private bool $mutatorEnabled = false;
    private bool $endMutationManually = false;
    protected mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    public function __get(string $name)
    {
        if ($name === 'flu') {
            return flu($this->value);
        }

        throw new \InvalidArgumentException("property('$name') does not exist");
    }

    protected function canCallMe(mixed $callable): bool //TODO tegelt seda justkui poleks vaja, äkki saaks teha map processor ->map->trim
    {
        return is_string($callable)
            && (str_starts_with($callable, 'self::') || str_starts_with($callable, 'static::'));
    }

    protected function newFrom(string $type, mixed $value): FluentValueProcessor
    {
        return $type === 'self' ? new self($value) : new static($value);
    }

    protected function executeMe(mixed $value, string $callable, mixed ...$callParams): FluentValueProcessor
    {
        [$type, $method] = explode('::', $callable);

        return $this->newFrom(
            $type,
            $this->newFrom($type, $value)->execute($method, ...$callParams)
        );
    }

    public function canExecute(string $method): bool
    {
        return method_exists($this, $method);
    }

    public function execute(string $method, mixed ...$param): mixed
    {
        return $this->$method(...$param);
    }

    public function propertyExists(string $property): bool
    {
        return $this->canExecute($property);
    }

    public function getPropertyValue(string $property): mixed
    {
        return $this->execute($property);
    }

    public function canConvertToFluent(mixed $value): bool
    {
        return true;//$value instanceof self;
    }

    public function getFluentValue(mixed $value): mixed
    {
        return $value;
    }

    /**
     * Get the underlying value
     *
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    protected function get(): mixed
    {
        return $this->getValue();
    }


    /**
     * Set underlying value
     *
     * @param  mixed  $value
     * @return $this
     */
    public function setValue(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function __toString()
    {
        return $this->toString();
    }

    //region PHP built interface implementations

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->getOffsetValue());
    }

    public function offsetGet($offset): mixed
    {
        return $this->value[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $offsetValue = $this->getOffsetValue();
        $offsetValue[$offset] = $value;
        $this->value = $offsetValue;
    }

    public function offsetUnset($offset): void
    {
        $offsetValue = $this->getOffsetValue();
        unset($offsetValue[$offset]);
        $this->value = $offsetValue;
    }

    public function count(): int
    {
        return $this->size();
    }

    private function getOffsetValue(): mixed
    {
        if (!$this->canOffset()) {
            throw new \InvalidArgumentException('cant use offset on '.$this->type());
        }
        if ($this->isString()) {
            return $this->characters();
        }

        return $this->value;
    }
    //endregion
}
