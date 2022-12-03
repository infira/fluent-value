<?php

namespace Infira\FluentValue\Traits;

use Illuminate\Support\Stringable;
use Infira\FluentValue\FluentChain;
use Infira\FluentValue\FluentValue;

/**
 * @mixin FluentValue
 */
trait ConditionMutators
{
    public function whenOk(mixed $success, mixed $default = null): static
    {
        return $this->when(fn() => $this->ok(), $success, $default);
    }

    public function whenOkChain(mixed $failedValue = null): FluentChain
    {
        if (func_num_args() == 0) {
            return $this->chain($this)->dontRunWhen(fn() => $this->notOk());
        }

        return $this->chain($this)->dontRunWhen(fn() => $this->notOk(), $failedValue);
    }

    public function whenNotOk(mixed $success, mixed $default = null): static
    {
        return $this->when(fn() => $this->notOk(), $success, $default);
    }

    public function when(mixed $value, mixed $success, mixed $default = null): static
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

        return $this->new($output);
    }

    public function unless(mixed $value, mixed $success, mixed $default = null): static
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

        return $this->new($output);
    }

    /**
     * @see Stringable::whenContains
     */
    public function whenContains(array|string $needles, mixed $success, mixed $default = null): static
    {
        return $this->when($this->contains($needles), $success, $default);
    }

    /**
     * @see Stringable::whenContainsAll
     */
    public function whenContainsAll(array $needles, mixed $success, mixed $default = null): static
    {
        return $this->when($this->containsAll($needles), $success, $default);
    }

    /**
     * @see Stringable::whenEmpty
     */
    public function whenEmpty(mixed $success, mixed $default = null): static
    {
        return $this->when($this->isEmpty(), $success, $default);
    }

    /**
     * @see Stringable::whenNotEmpty
     */
    public function whenNotEmpty(mixed $success, mixed $default = null): static
    {
        return $this->when($this->isNotEmpty(), $success, $default);
    }

    /**
     * @see Stringable::whenEndsWith
     */
    public function whenEndsWith($needles, mixed $success, mixed $default = null): static
    {
        return $this->when($this->endsWith($needles), $success, $default);
    }

    /**
     * @see Stringable::whenExactly
     */
    public function whenExactly($value, mixed $success, mixed $default = null): static
    {
        return $this->when($this->exactly($value), $success, $default);
    }

    /**
     * @see Stringable::whenNotExactly
     */
    public function whenNotExactly($value, mixed $success, mixed $default = null): static
    {
        return $this->when(!$this->exactly($value), $success, $default);
    }

    /**
     * @see Stringable::whenIs
     */
    public function whenIs($pattern, mixed $success, mixed $default = null): static
    {
        return $this->when($this->is($pattern), $success, $default);
    }

    /**
     * @see Stringable::whenIsAscii
     */
    public function whenIsAscii(mixed $success, mixed $default = null): static
    {
        return $this->when($this->isAscii(), $success, $default);
    }

    /**
     * @see Stringable::whenIsUuid
     */
    public function whenIsUuid(mixed $success, mixed $default = null): static
    {
        return $this->when($this->isUuid(), $success, $default);
    }

    /**
     * @see Stringable::whenStartsWith
     */
    public function whenStartsWith($needles, mixed $success, mixed $default = null): static
    {
        return $this->when($this->startsWith($needles), $success, $default);
    }

    /**
     * @see Stringable::whenTest
     */
    public function whenTest($pattern, mixed $success, mixed $default = null): static
    {
        return $this->when($this->test($pattern), $success, $default);
    }
}