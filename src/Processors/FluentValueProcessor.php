<?php

namespace Infira\FluentValue\Processors;

use Illuminate\Support\Stringable;
use Infira\FluentValue\Chain\FluentChain;
use Infira\FluentValue\Contracts\Processor;
use Infira\FluentValue\Flu;
use Infira\FluentValue\FluentValue;

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
    \Stringable,
    Processor
{
    public const UNDEFINED = '_UNDEFINED_';
    use \Infira\FluentValue\Traits\Helpers;
    use Traits\CallableProperties,
        Traits\Finals;

    //processors
    use Traits\Miscellaneous,
        Traits\Hashing,
        Traits\Numbers,
        Traits\MoneyAndTaxes,
        Traits\Dates,
        Traits\Strings,
        Traits\HtmlManipulation,
        Traits\Arrays,
        Traits\Files,
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

    protected function extractFluMethod(mixed $callable): ?array
    {
        if (is_string($callable) && str_starts_with($callable, 'flu::')) {
            $callables = Flu::at(1, explode('::', $callable));
            if (!$callables) {
                return null;
            }

            return explode('->', $callables);
        }

        return null;
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
        if (!in_array($property, $this->getProxies())) {
            return false;
        }

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
    public function value(): mixed
    {
        return $this->value;
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
        if ($this->isArray()) {
            return array_key_exists($offset, $this->value);
        }

        return isset($this->value[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->value[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->setValue(Flu::setAt($offset, $this->value, $value));
    }

    public function offsetUnset($offset): void
    {
        $this->setValue(Flu::removeAt($offset, $this->value));
    }

    public function count(): int
    {
        return $this->size();
    }
    //endregion
}
