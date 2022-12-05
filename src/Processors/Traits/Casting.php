<?php

namespace Infira\FluentValue\Processors\Traits;

use Infira\FluentValue\Processors\FluentValueProcessor;

/**
 * @template TValue
 * @template TKey
 * @mixin FluentValueProcessor
 */
trait Casting
{
    /**
     * Get the underlying string value as a boolean.
     * Returns true when value is "1", "true", "on", and "yes". Otherwise, returns false.
     *
     * @aliasof FluentImmutableValue::toBool()
     * @aliasof FluentImmutableValue::toBoolean()
     * @uses FluentImmutableValue::$bool - transform underlying value to bool
     * @return bool
     */
    public function bool(): bool
    {
        if ($this->isString()) {
            return filter_var(trim($this->value), FILTER_VALIDATE_BOOLEAN);
        }

        return (bool)$this->value;
    }

    /**
     * Cast to int
     *
     * @aliasof FluentImmutableValue::toInt()
     * @aliasof FluentImmutableValue::toInteger()
     * @return int
     * @uses FluentImmutableValue::$int - transform underlying value to integer
     */
    public function int(): int
    {
        if ($this->isString()) {
            return (int)trim($this->value);
        }

        return (int)$this->value;
    }

    /**
     * Cast to array
     *
     * @aliasof FluentImmutableValue::toFloat()
     * @return float
     * @uses FluentImmutableValue::$float - transform underlying value to float
     */
    public function float(): float
    {
        return (float)$this->value;
    }

    /**
     * @aliasof FluentImmutableValue::toArray()
     * @return array
     * @uses FluentImmutableValue::$array - transform underlying value to array
     */
    public function array(): array
    {
        return (array)$this->value;
    }

    /**
     * Get string
     *
     * @aliasof FluentImmutableValue::toString()
     * @return string
     * @uses FluentImmutableValue::$string - transform underlying value to string
     */
    public function string(): string
    {
        return (string)$this->value;
    }

    /**
     * Get the type of variable
     *
     * @aliasof FluentImmutableValue::toType()
     * @uses FluentImmutableValue::$type - transform underlying value to variable type
     * @return string
     */
    public function type(): string
    {
        return gettype($this->value);
    }
}