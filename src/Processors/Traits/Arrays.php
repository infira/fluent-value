<?php

namespace Infira\FluentValue\Processors\Traits;

use Illuminate\Support\Arr;
use Infira\FluentValue\Processors\FluentValueProcessor;
use Wolo\Closure;

/**
 * @template TValue
 * @template TKey
 * @mixin FluentValueProcessor
 */
trait Arrays
{
    /**
     * Merge array
     *
     * @aliasof FluentImmutableValue::getMerged()
     * @param  array  ...$array
     * @return array
     */
    public function merge(array ...$array): array
    {
        return array_merge($this->value, ...$array);
    }

    /**
     * Run a filter over each of the items.
     *
     * @param  (callable(TKey,TValue): mixed)|null  $callback  - "self::method" or "static::method" will be called Using FluentValue
     * @return array
     * @aliasof FluentImmutableValue::getFiltered()
     * @uses FluentImmutableValue::$filter - reject empty
     */
    public function filter(callable $callback = null): array
    {
        if (!$callback) {
            return array_filter($this->value);
        }

        if ($this->canCallMe($callback)) {
            return $this->filter(fn($item) => $this->executeMe($item, $callback)->bool());
        }

        return array_filter(
            $this->value,
            Closure::makeInjectableOrVoid($callback),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * Rejects items using truth test
     *
     * @param  (callable(TKey,TValue): mixed)|null  $callback  - "self::method" or "static::method" will be called Using FluentValue
     * @return array
     * @aliasof FluentImmutableValue::getRejected()
     * @uses FluentImmutableValue::$reject - reject not empty
     */
    public function reject(callable $callback = null): array
    {
        if (!$callback) {
            return array_filter($this->value, static fn($item) => !empty($item));
        }

        if ($this->canCallMe($callback)) {
            return $this->reject(fn($item) => $this->executeMe($item, $callback)->bool());
        }

        return array_filter(
            $this->value,
            static fn($item, $key) => !Closure::makeInjectableOrVoid($callback)($item, $key),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * Explodes, then value and then filters out empty values
     *
     * @aliasof FluentImmutableValue::getExplodedEmptyRejected()
     * @param  string  $separator
     * @return array
     */
    public function explodeRejectEmpty(string $separator): array
    {
        return array_filter(
            $this->explodeTrim($separator),
            static fn($item) => !empty($item),
        );
    }

    /**
     * Explodes, then trims each value
     *
     * @aliasof FluentImmutableValue::toExplodeTrim()
     * @param  string  $separator
     * @return array
     */
    public function explodeTrim(string $separator): array
    {
        return array_map('trim', explode($separator, $this->value));
    }

    /**
     * Return the first element in an array passing a given truth test.
     *
     * @param  (callable(TKey,TValue): mixed)|null  $callback
     * @param  null  $default
     * @return mixed
     * @see  Arr::first()
     * @aliasof FluentImmutableValue::getFirst()
     * @uses FluentImmutableValue::$first
     */
    public function first(callable $callback = null, $default = null): mixed
    {
        return Arr::first($this->value, Closure::makeInjectableOrVoid($callback), $default);
    }

    /**
     * Return the last element in an array passing a given truth test.
     *
     * @param  (callable(TKey,TValue): mixed)|null  $callback
     * @param  null  $default
     * @return mixed
     * @see  Arr::last()
     * @aliasof FluentImmutableValue::getLast()
     * @uses FluentImmutableValue::$last
     */
    public function last(callable $callback = null, $default = null): mixed
    {
        return Arr::last($this->value, Closure::makeInjectableOrVoid($callback), $default);
    }

    /**
     * Applies the callback to the elements of the given arrays
     * Closure callable is injectable ex ->edit(\MyClass $value) // will call $editor(MyClass(TValue))
     * "self::method" or "static::method" will be called Using FluentValue
     *
     * @param  (callable(TKey,TValue): mixed)  $callback
     * @param  mixed  ...$arg  extra arguments passed to callback
     * @return array
     * @aliasof FluentImmutableValue::getMapped()
     */
    public function map(callable $callback, mixed...$arg): array
    {
        if ($this->canCallMe($callback)) {
            return $this->map(fn($item) => $this->executeMe($item, $callback, $arg)->getValue());
        }

        if (is_string($callback)) {
            return array_map($callback, $this->value);
        }

        $keys = array_keys($this->value);
        $items = array_map(Closure::makeInjectableOrVoid($callback), $this->value, [...$keys, ...$arg]);

        return array_combine($keys, $items);
    }

    /**
     * Run an associative map over each of the items.
     * The callback should return an associative array with a single key/value pair.
     *
     * @param  (callable(TKey,TValue): mixed)  $callback
     * @return array
     * @aliasof FluentImmutableValue::getMappedWithKeys()
     */
    public function mapWithKeys(callable $callback): array
    {
        $callback = Closure::makeInjectableOrVoid($callback);
        $newArray = [];
        foreach ($this->value as $key => $value) {
            $assoc = $callback($value, $key);
            foreach ($assoc as $mapKey => $mapValue) {
                $newArray[$mapKey] = $mapValue;
            }
        }

        return $newArray;
    }
}