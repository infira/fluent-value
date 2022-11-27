<?php

namespace Infira\FluentValue\Traits;

use Illuminate\Support\Stringable;
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

    public function whenNotOk(mixed $success, mixed $default = null): static
    {
        return $this->when(fn() => $this->notOk(), $success, $default);
    }

    public function when(mixed $check, mixed $success, mixed $default = null): static
    {
        if (!is_callable($success)) {
            $success = static fn() => $success;
        }

        if (!is_callable($default)) {
            $default = static fn() => $default;
        }

        return $this->new($this->stringable()->when($check, $success, $default));
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