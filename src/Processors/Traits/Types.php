<?php

namespace Infira\FluentValue\Processors\Traits;

use Infira\FluentValue\Flu;
use Wolo\Contracts\UnderlyingValue;

/**
 * @template TValue
 * @template TKey
 * @mixin UnderlyingValue
 */
trait Types
{
    /**
     * Get the underlying string value as a boolean.
     * Returns true when value is "1", "true", "on", and "yes". Otherwise, returns false.
     *
     * @return bool
     * @uses FluentImmutableValue::bool() - transform underlying value to bool
     * @uses FluentImmutableValue::$bool - transform underlying value to bool
     */
    public function toBool(): bool
    {
        if ($this->isString()) {
            return filter_var(trim($this->value()), FILTER_VALIDATE_BOOLEAN);
        }

        return (bool)$this->value();
    }

    public function toBoolean(): bool
    {
        return $this->toBool();
    }

    public function toNumeric(): float|int
    {
        return Flu::numeric($this->value);
    }

    public function isBool(): bool
    {
        return is_bool($this->value());
    }

    /**
     * Cast to int
     *
     * @return int
     * @uses FluentImmutableValue::int() - transform underlying value to integer
     * @uses FluentImmutableValue::$int - transform underlying value to integer
     */
    public function toInt(): int
    {
        if ($this->isString()) {
            return (int)trim($this->value());
        }

        return (int)$this->value();
    }

    public function toInteger(): bool
    {
        return $this->toInt();
    }

    public function isInt(): bool
    {
        return is_int($this->value());
    }

    /**
     * Cast to array
     *
     * @return float
     * @uses FluentImmutableValue::float() - transform underlying value to float
     * @uses FluentImmutableValue::$float - transform underlying value to float
     */
    public function toFloat(): float
    {
        return (float)$this->value();
    }

    public function isFloat(): bool
    {
        return is_float($this->value());
    }

    public function isNumeric(): bool
    {
        return is_numeric($this->value());
    }

    /**
     * @return array
     * @uses FluentImmutableValue::array() - transform underlying value to array
     * @uses FluentImmutableValue::$array - transform underlying value to array
     */
    public function toArray(): array
    {
        return (array)$this->value();
    }

    /**
     * Get string
     *
     * @return string
     * @uses FluentImmutableValue::string() - transform underlying value to string
     * @uses FluentImmutableValue::$string - transform underlying value to string
     */
    public function toString(): string
    {
        return (string)$this->value();
    }

    public function jsonSerialize(): string|array
    {
        if ($this->isArray()) {
            return $this->value();
        }

        return (string)$this->value();
    }

    public function isString(): bool
    {
        return is_string($this->value());
    }

    /**
     * Get the type of variable
     *
     * @return string
     * @uses FluentImmutableValue::type() - transform underlying value to variable type
     * @uses FluentImmutableValue::$type - transform underlying value to variable type
     */
    public function toType(): string
    {
        return gettype($this->value());
    }

    /**
     * Check variable type
     *
     * @param string $type
     * @return bool
     */
    public function isType(string $type): bool
    {
        return $this->type() === $type;
    }

    public function isNull(): bool
    {
        return is_null($this->value());
    }

    public function isArray(): bool
    {
        return is_array($this->value());
    }

    public function isIterable(): bool
    {
        return is_iterable($this->value());
    }

    public function isCountable(): bool
    {
        return is_countable($this->value());
    }

    public function isObject(): bool
    {
        return is_object($this->value());
    }

    public function isInstanceof($of): bool
    {
        return $this->value() instanceof $of;
    }

    public function isEmpty(): bool
    {
        return empty($this->value());
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }
}