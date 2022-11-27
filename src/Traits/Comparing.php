<?php

namespace Infira\FluentValue\Traits;

use Infira\FluentValue\FluentValue;
use Wolo\Is;

/**
 * @mixin FluentValue
 */
trait Comparing
{
    public function isBool(): bool
    {
        return is_bool($this->value);
    }

    public function isInt(): bool
    {
        return is_int($this->value);
    }

    public function isString(): bool
    {
        return is_string($this->value);
    }

    public function isFloat(): bool
    {
        return is_float($this->value);
    }

    public function isNumeric(): bool
    {
        return is_numeric($this->value);
    }

    public function isNull(): bool
    {
        return is_null($this->value);
    }

    public function isArray(): bool
    {
        return is_array($this->value);
    }

    public function isObject(): bool
    {
        return is_object($this->value);
    }

    public function equals(mixed $val, bool $strict = true): bool
    {
        if ($strict) {
            return $this->value === $this->pv($val);
        }

        return $this->value == $this->pv($val);
    }

    public function notEquals(mixed $val, bool $strict = true): bool
    {
        return !$this->equals($val, $strict);
    }

    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * Has conditional value
     * When value is string and "1", "true", "on", and "yes" then returns true
     * Otherwise it validates using empty()
     * @see  Is::ok()
     */
    public function ok(): bool
    {
        return Is::ok($this->value);
    }

    /** @see static::ok() */
    public function notOk(): bool
    {
        return !$this->ok();
    }

    /**
     * @see \Illuminate\Support\Stringable::is()
     */
    public function isNot(string|array $pattern): bool
    {
        return !$this->is($pattern);
    }

    /**
     * Determine if value offset exists
     * When value sis array then uses array_key exists
     * When value is object and offsetMethod
     * @param  string|int  $key
     * @return bool
     */
    public function has(string|int $key): bool
    {
        if ($this->isString()) {
            return $this->offsetExists($key);
        }
        if ($this->isObject() && method_exists($this->value, 'offsetExists')) {
            return $this->value->offsetExists($key);
        }
        if ($this->isArray()) {
            return array_key_exists($key, $this->value);
        }

        return false;
    }

    public function isBetweenRange(mixed $from, mixed $to): bool
    {
        return Is::between($this->numericValue($from), $this->numericValue($to), $this->value);
    }

    public function isBigger(mixed $to): bool
    {
        return $this->value > $this->numericValue($to);
    }

    public function isBiggerEq(mixed $to): bool
    {
        return $this->value >= $this->numericValue($to);
    }

    public function isSmaller(mixed $to): bool
    {
        return $this->value < $this->numericValue($to);
    }

    public function isSmallerEq(mixed $to): bool
    {
        return $this->value <= $this->numericValue($to);
    }
}