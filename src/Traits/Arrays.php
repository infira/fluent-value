<?php

namespace Infira\FluentValue\Traits;

use Illuminate\Support\Arr;
use Wolo\Closure;
use Infira\FluentValue\FluentValue;

/**
 * @mixin FluentValue
 */
trait Arrays
{
    /**
     * Merge array
     * @link https://www.php.net/manual/en/function.parse-str.php
     * @uses static::merge()
     */
    public function getMerged(array ...$array): array
    {
        return array_merge($this->value, ...$array);
    }

    /** Is current value in array */
    public function inArray(array|FluentValue $array, bool $strict = false): bool
    {
        return in_array($this->value, $this->pv($array), $strict);
    }

    /** Is current value NOT in array */
    public function notInArray(array|FluentValue $array, bool $strict = false): bool
    {
        return !$this->inArray($array, $strict);
    }

    /**
     * Run a filter over each of the items.
     * @param  callable|null  $callback  - "self::method" or "static::method" will be called Using FluentValue
     * @return static
     * @link gttps://php.net/manual/en/function.array-filter.php
     */
    public function filter(callable $callback = null): static
    {
        if (!$callback) {
            return $this->new(array_filter($this->value));
        }

        if (is_string($callback) && str_starts_with($callback, 'self::')) {
            return $this->filter(fn($item) => (bool)$this->fluValue((new self($item))->{substr($callback, 6)}()));
        }

        if (is_string($callback) && str_starts_with($callback, 'static::')) {
            return $this->filter(fn($item) => (bool)$this->fluValue((new static($item))->{substr($callback, 8)}()));
        }


        return $this->new(
            array_filter(
                $this->value,
                Closure::makeInjectableOrVoid($callback),
                ARRAY_FILTER_USE_BOTH
            )
        );
    }

    /**
     * Rejects items using truth test
     * @param  callable|null  $callback  - "self::method" or "static::method" will be called Using FluentValue
     * @return static
     */
    public function reject(callable $callback = null): static
    {
        if (!$callback) {
            return $this->new(array_filter($this->value, static fn($item) => !empty($item)));
        }

        if (is_string($callback) && str_starts_with($callback, 'self::')) {
            return $this->filter(fn($item) => (bool)$this->fluValue((new self($item))->{substr($callback, 6)}()));
        }

        if (is_string($callback) && str_starts_with($callback, 'static::')) {
            return $this->reject(fn($item) => (bool)$this->fluValue((new static($item))->{substr($callback, 8)}()));
        }

        return $this->new(
            array_filter(
                $this->value,
                static fn($item, $key) => !Closure::makeInjectableOrVoid($callback)($item, $key),
                ARRAY_FILTER_USE_BOTH
            )
        );
    }

    /**
     * Explodes, then value and then filters out empty values
     */
    public function explodeRejectEmpty(string $separator): static
    {
        return $this->explodeTrim($separator)->reject();
    }

    /**
     * Explodes, then trims each value
     */
    public function explodeTrim(string $separator): static
    {
        return $this->explode($separator)->map('trim');
    }

    /**
     * Return the first element in an array passing a given truth test.
     * @see  Arr::first()
     * @uses static::first()
     */
    public function toFirst(callable $callback = null, $default = null): mixed
    {
        return Arr::first($this->value, Closure::makeInjectableOrVoid($callback), $default);
    }

    /**
     * Return the last element in an array passing a given truth test.
     * @see  Arr::last()
     * @uses static::last()
     */
    public function toLast(callable $callback = null, $default = null): mixed
    {
        return Arr::last($this->value, Closure::makeInjectableOrVoid($callback), $default);
    }

    /**
     * Applies the callback to the elements of the given arrays
     *
     * @param  callable  $callback  - "self::method" or "static::method" will be called Using FluentValue
     * @param  mixed  ...$arg  extra arguments passed to callback
     * @return $this
     */
    public function map(callable $callback, mixed...$arg): static
    {
        if (is_string($callback) && str_starts_with($callback, 'self::')) {
            return $this->map(fn($item) => $this->fluValue((new self($item))->{substr($callback, 6)}(...$arg)));
        }

        if (is_string($callback) && str_starts_with($callback, 'static::')) {
            return $this->map(fn($item) => $this->fluValue((NEW static($item))->{substr($callback, 8)}(...$arg)));
        }

        if (is_string($callback)) {
            return $this->new(array_map($callback, $this->value));
        }

        $keys = array_keys($this->value);
        $items = array_map(Closure::makeInjectableOrVoid($callback), $this->value, [...$keys, ...$arg]);

        return $this->new(array_combine($keys, $items));
    }

    /**
     * Run an associative map over each of the items.
     * The callback should return an associative array with a single key/value pair.
     *
     * @param  callable  $callback
     * @return static
     */
    public function mapWithKeys(callable $callback): static
    {
        $callback = Closure::makeInjectableOrVoid($callback);
        $newArray = [];
        foreach ($this->value as $key => $value) {
            $assoc = $callback($value, $key);
            foreach ($assoc as $mapKey => $mapValue) {
                $newArray[$mapKey] = $mapValue;
            }
        }

        return $this->new($newArray);
    }

    /**
     * execute a callback over each item.
     */
    public function each(callable $callback): static
    {
        $callback = Closure::makeInjectableOrVoid($callback);
        foreach ($this->value as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }
}