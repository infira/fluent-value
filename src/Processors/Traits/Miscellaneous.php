<?php

namespace Infira\FluentValue\Processors\Traits;

/**
 * @template TKey
 * @template TValue
 * @uses FluentValueProcessor
 */
trait Miscellaneous
{
    /**
     * Append values works for array and strings
     *
     * @param  mixed  ...$values
     * @return array|mixed|string
     */
    public function append(mixed ...$values): mixed
    {
        if ($this->isIterable()) {
            return $this->push(...$values);
        }

        return $this->value.implode('', $values);
    }

    /**
     * Append values works for array and strings
     *
     * @param  mixed  ...$values
     * @return array|string
     */
    public function prepend(mixed ...$values): array|string
    {
        if ($this->isIterable()) {
            $arr = $this->value;
            array_unshift($arr, ...$values);

            return $arr;
        }

        return implode('', $values).$this->value;
    }

    /**
     * @param  (callable(TKey,TValue): mixed)  $callback
     * @param  mixed  ...$parameter
     * @return $this
     */
    public function transform(callable $callback, mixed ...$parameter): static
    {
        if ($this->isArray()) {
            $this->setValue($this->map(fn($value) => $callback($value, ...$parameter)));
        }
        else {
            $this->setValue($callback($this->value, ...$parameter));
        }

        return $this;
    }

    /**
     * Does offset value exists
     *
     * @param  string|int  $key
     * @return bool
     */
    public function has(string|int $key): bool
    {
        return $this->offsetExists($key);
    }

    /**
     * Get offset value
     *
     * @template TGetDefault
     * @template TValue
     *
     * @param  string|int  $key
     * @param  TGetDefault  $default
     * @return TValue|TGetDefault
     */
    public function at(string|int $key, mixed $default = null): mixed
    {
        if (!$this->has($key)) {
            return $default;
        }

        return $this->offsetGet($key);
    }

    /**
     * Remove offset value
     *
     * @param  string|int  $key
     * @return $this
     */
    public function forget(string|int $key): static
    {
        $this->offsetUnset($key);

        return $this;
    }

    /**
     * Get size, if underlying value is array then count else strlen
     *
     * @return int
     * @uses FluentImmutableValue::$size - transform underlying value using count()/strlen()
     */
    public function size(): int
    {
        if ($this->isCountable()) {
            return count($this->value);
        }

        return $this->strlen();
    }


}