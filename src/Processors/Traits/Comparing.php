<?php

namespace Infira\FluentValue\Processors\Traits;

use Infira\FluentValue\Flu;
use Wolo\Is;

trait Comparing
{
    /**
     * @uses FluentImmutableValue::$isBool
     * @final
     */
    public function isBool(): bool
    {
        return is_bool($this->value);
    }

    /**
     * @uses FluentImmutableValue::$isInt
     * @final
     */
    public function isInt(): bool
    {
        return is_int($this->value);
    }

    /**
     * @uses FluentImmutableValue::$isString
     * @final
     */
    public function isString(): bool
    {
        return is_string($this->value);
    }

    /**
     * @uses FluentImmutableValue::$isFloat
     * @final
     */
    public function isFloat(): bool
    {
        return is_float($this->value);
    }

    /**
     * @uses FluentImmutableValue::$isNumeric
     * @final
     */
    public function isNumeric(): bool
    {
        return is_numeric($this->value);
    }

    /**
     * @uses FluentImmutableValue::$isNull
     * @final
     */
    public function isNull(): bool
    {
        return is_null($this->value);
    }

    /**
     * @uses FluentImmutableValue::$isArray
     * @final
     */
    public function isArray(): bool
    {
        return is_array($this->value);
    }

    /**
     * @uses FluentImmutableValue::$isIterable
     * @final
     */
    public function isIterable(): bool
    {
        return is_iterable($this->value);
    }

    /**
     * @uses FluentImmutableValue::$isCountable
     * @final
     */
    public function isCountable(): bool
    {
        return is_countable($this->value);
    }

    /**
     * @uses FluentImmutableValue::$isObject
     * @final
     */
    public function isObject(): bool
    {
        return is_object($this->value);
    }

    /**
     * @uses FluentImmutableValue::$canOffset
     * @final
     */
    public function canOffset(): bool
    {
        if ($this->value instanceof \ArrayAccess) {
            return true;
        }

        if ($this->isArray() || $this->isString()) {
            return true;
        }

        return false;
    }

    /** @final */
    public function equals(mixed $val, bool $strict = true): bool
    {
        if ($strict) {
            return $this->value === $val;
        }

        return $this->value == $val;
    }

    /** @final */
    public function notEquals(mixed $val, bool $strict = true): bool
    {
        return !$this->equals($val, $strict);
    }

    /**
     * @uses FluentImmutableValue::$isEmpty
     * @final
     */
    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    /**
     * @uses FluentImmutableValue::$isNotEmpty
     * @final
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * Has conditional value
     * When value is string and "1", "true", "on", and "yes" then returns true
     * Otherwise it validates using empty()
     *
     * @see  Is::ok()
     * @uses FluentImmutableValue::$ok
     * @final
     */
    public function ok(): bool
    {
        return Is::ok($this->value);
    }

    /**
     * @see  static::ok()
     * @uses FluentImmutableValue::$notOk
     * @final
     */
    public function notOk(): bool
    {
        return !$this->ok();
    }

    /**
     * @see \Illuminate\Support\Stringable::is()
     * @final
     */
    public function isNot(string|array $pattern): bool
    {
        return !$this->is($pattern);
    }

    /**
     * @final
     */
    public function isBetweenRange(mixed $from, mixed $to): bool
    {
        return Is::between(Flu::numeric($from), Flu::numeric($to), $this->value);
    }

    /**
     * @final
     */
    public function isBigger(mixed $to): bool
    {
        return $this->value > Flu::numeric($to);
    }

    /**
     * @final
     */
    public function isBiggerEq(mixed $to): bool
    {
        return $this->value >= Flu::numeric($to);
    }

    /**
     * @final
     */
    public function isSmaller(mixed $to): bool
    {
        return $this->value < Flu::numeric($to);
    }

    /**
     * @final
     */
    public function isSmallerEq(mixed $to): bool
    {
        return $this->value <= Flu::numeric($to);
    }

    /**
     * Is current value in array
     *
     * @final
     */
    public function inArray(array $array, bool $strict = false): bool
    {
        return in_array($this->value, $array, $strict);
    }

    /** Is current value NOT in array
     *
     * @final
     */
    public function notInArray(array $array, bool $strict = false): bool
    {
        return !$this->inArray($array, $strict);
    }
}