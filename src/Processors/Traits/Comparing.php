<?php

namespace Infira\FluentValue\Processors\Traits;

use Infira\FluentValue\Flu;
use Wolo\Is;

trait Comparing
{
    public function equals(mixed $val, bool $strict = true): bool
    {
        if ($strict) {
            return $this->value() === $val;
        }

        return $this->value() == $val;
    }

    public function notEquals(mixed $val, bool $strict = true): bool
    {
        return !$this->equals($val, $strict);
    }

    /**
     * Has conditional value
     * When value is string and "1", "true", "on", and "yes" then returns true
     * Otherwise it validates using empty()
     *
     * @see  Is::ok()
     */
    public function ok(): bool
    {
        return Is::ok($this->value());
    }

    /**
     * @see  static::ok()
     */
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

    public function isBetweenRange(mixed $from, mixed $to): bool
    {
        return Is::between($this->numeric(), $from, $to);
    }

    public function isBigger(mixed $to): bool
    {
        return $this->value() > Flu::numeric($to);
    }

    public function isBiggerEq(mixed $to): bool
    {
        return $this->value() >= Flu::numeric($to);
    }

    public function isSmaller(mixed $to): bool
    {
        return $this->value() < Flu::numeric($to);
    }

    public function isSmallerEq(mixed $to): bool
    {
        return $this->value() <= Flu::numeric($to);
    }

    /**
     * Is current value in array
     */
    public function inArray(array $array, bool $strict = false): bool
    {
        return in_array($this->value(), $array, $strict);
    }

    /**
     * Is current value NOT in array
     */
    public function notInArray(array $array, bool $strict = false): bool
    {
        return !$this->inArray($array, $strict);
    }
}