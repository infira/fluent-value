<?php

namespace Infira\FluentValue\Processors\Traits;

use Illuminate\Support\Stringable;
use Infira\FluentValue\Processors\FluentValueProcessor;

/**
 * @mixin FluentValueProcessor
 */
trait Conditions
{
    /**
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     */
    public function whenOk(mixed $success, mixed $default = null): mixed
    {
        return $this->when(fn() => $this->ok(), $success, $default);
    }

    /**
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     */
    public function whenNotOk(mixed $success, mixed $default = null): mixed
    {
        return $this->when(fn() => $this->notOk(), $success, $default);
    }

    /**
     * @param  mixed  $value
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     */
    public function when(mixed $value, mixed $success, mixed $default = null): mixed
    {
        if ($success !== null && !is_callable($success)) {
            $success = static fn() => $success;
        }

        if ($default !== null && !is_callable($default)) {
            $default = static fn() => $default;
        }

        $value = $value instanceof \Closure ? $value($this) : $value;
        if ($value) {
            $output = $success($this, $value) ?? $this;
        }
        elseif ($default) {
            $output = $default($this, $value) ?? $this;
        }
        else {
            return $this;
        }

        return $output;
    }

    /**
     * @param  mixed  $value
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     */
    public function unless(mixed $value, mixed $success, mixed $default = null): mixed
    {
        if ($success !== null && !is_callable($success)) {
            $success = static fn() => $success;
        }

        if ($default !== null && !is_callable($default)) {
            $default = static fn() => $default;
        }

        $value = $value instanceof \Closure ? $value($this) : $value;
        if (!$value) {
            $output = $success($this, $value) ?? $this;
        }
        elseif ($default) {
            $output = $default($this, $value) ?? $this;
        }
        else {
            return $this;
        }

        return $output;
    }

    /**
     * @param  array|string  $needles
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenContains()
     */
    public function whenContains(array|string $needles, mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->contains($needles), $success, $default);
    }

    /**
     * @param  array  $needles
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenContainsAll()
     */
    public function whenContainsAll(array $needles, mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->containsAll($needles), $success, $default);
    }

    /**
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenEmpty()
     */
    public function whenEmpty(mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->isEmpty(), $success, $default);
    }

    /**
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenNotEmpty()
     */
    public function whenNotEmpty(mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->isNotEmpty(), $success, $default);
    }

    /**
     * @param $needles
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenEndsWith()
     */
    public function whenEndsWith($needles, mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->endsWith($needles), $success, $default);
    }

    /**
     * @param $value
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenExactly()
     */
    public function whenExactly($value, mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->exactly($value), $success, $default);
    }

    /**
     * @param $value
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenNotExactly()
     */
    public function whenNotExactly($value, mixed $success, mixed $default = null): mixed
    {
        return $this->when(!$this->exactly($value), $success, $default);
    }

    /**
     * @param $pattern
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenIs()
     */
    public function whenIs($pattern, mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->is($pattern), $success, $default);
    }

    /**
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenIsAscii()
     */
    public function whenIsAscii(mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->isAscii(), $success, $default);
    }

    /**
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenIsUuid()
     */
    public function whenIsUuid(mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->isUuid(), $success, $default);
    }

    /**
     * @param $needles
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenStartsWith()
     */
    public function whenStartsWith($needles, mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->startsWith($needles), $success, $default);
    }

    /**
     * @param $pattern
     * @param  mixed  $success
     * @param  mixed|null  $default
     * @return mixed
     * @see  Stringable::whenTest()
     */
    public function whenTest($pattern, mixed $success, mixed $default = null): mixed
    {
        return $this->when($this->test($pattern), $success, $default);
    }
}