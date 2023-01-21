<?php

namespace Infira\FluentValue\Processors\Traits;

use Illuminate\Support\Arr;
use Infira\FluentValue\Facade\Callables;
use Infira\FluentValue\FluentValue;
use Infira\FluentValue\Processors\FluentValueProcessor;

/**
 * @template TValue
 * @template TKey
 * @template Immutable
 * @mixin FluentValueProcessor
 */
trait Arrays
{
    private function validateArray(string $method): void
    {
        if (!$this->isArray()) {
            throw new \RuntimeException("cant initiate $method on non array ");
        }
    }

    /**
     * Merge array
     *
     * @param  array  ...$array
     * @return array
     */
    public function merge(array ...$array): array
    {
        return array_merge($this->value, ...$array);
    }

    /**
     * Get array keys
     *
     * @return array
     * @uses FluentImmutableValue::$keys
     */
    public function keys(): array
    {
        return array_keys($this->value);
    }

    /**
     * Run a filter over each of the items.
     *
     * @param  (callable(TKey,TValue): mixed)|null  $callback  - "self::method" or "static::method" will be called Using FluentValue
     * @return array
     * @uses FluentImmutableValue::$filter - reject empty
     */
    public function filter(callable $callback = null): array
    {
        if (!$callback) {
            return array_filter($this->value);
        }

        if ($fluMethod = $this->extractFluMethod($callback)) {
            return $this->filter(fn(FluentValue $item) => $item->{$fluMethod}()->bool());
        }

        return array_filter(
            $this->value,
            Callables::makeInjectable($callback),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * Add items to, if not exists new array will be created
     * It is same as flu([])['key'] = $value
     *
     * @param  string|int  $key
     * @param  mixed  ...$values
     * @return array
     * @template Immutable
     */
    public function pushTo(string|int $key, mixed ...$values): array
    {
        $arr = $this->value;
        if (!isset($this->value[$key])) {
            $arr[$key] = [];
        }
        foreach ($values as $value) {
            $arr[$key][] = $value;
        }

        return $arr;
    }

    /**
     * Push values to array
     *
     * @param  mixed  ...$values
     * @return array
     * @template Immutable
     */
    public function push(mixed ...$values): array
    {
        $arr = $this->value;
        foreach ($values as $value) {
            $arr[] = $value;
        }

        return $arr;
    }

    /**
     * Rejects items using truth test
     *
     * @param  (callable(TKey,TValue): mixed)|null  $callback  - "self::method" or "static::method" will be called Using FluentValue
     * @return array
     * @uses FluentImmutableValue::$reject - reject not empty
     */
    public function reject(callable $callback = null): array
    {
        if (!$callback) {
            return array_filter($this->value, static fn($item) => !empty($item));
        }

        if ($fluMethod = $this->extractFluMethod($callback)) {
            return $this->reject(fn(FluentValue $item) => $item->{$fluMethod}()->bool());
        }

        return array_filter(
            $this->value,
            static fn($item, $key) => !Callables::makeInjectable($callback)($item, $key),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * Explodes, then value and then filters out empty values
     *
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
     * @uses FluentImmutableValue::$first
     */
    public function first(callable $callback = null, $default = null): mixed
    {
        return Arr::first($this->value, Callables::makeInjectable($callback), $default);
    }

    /**
     * Return the last element in an array passing a given truth test.
     *
     * @param  (callable(TKey,TValue): mixed)|null  $callback
     * @param  null  $default
     * @return mixed
     * @see  Arr::last()
     * @uses FluentImmutableValue::$last
     */
    public function last(callable $callback = null, $default = null): mixed
    {
        return Arr::last($this->value, Callables::makeInjectable($callback), $default);
    }

    /**
     * Applies the callback to the elements of the given arrays
     * Closure callable is injectable ex ->edit(\MyClass $value) // will call $editor(new \MyClass(TValue))
     * "flu::method" will be mapped with flu($arrayItem)->method(...$arg)
     *
     * @example flu([' 1',' 2',' hello'])->map('flu::trim->eur') //['1,00€','2,00€','0,00€]
     * @example flu([' 1',' 2',' hello'])->map('trim->intval') //[1,2,0]
     * @example flu([' 1',' 2',' hello'])->map(['trim','intval']) //[1,2,0]
     * @param  (callable(TKey,TValue): mixed)|(callable(TKey,TValue): mixed)[]|string  $callback
     * @param  mixed  ...$arg  extra arguments passed to callback
     * @return array
     */
    public function map(callable|string|array $callback, mixed...$arg): array
    {
        if ($fluMethod = $this->extractFluMethod($callback)) {
            return $this->map(fn(FluentValue $item) => $item->execute($fluMethod, ...$arg)->value());
        }

        if (is_string($callback) && str_contains($callback, '->')) {
            return $this->map(array_map('trim', explode('->', $callback)));
        }

        if (is_array($callback) && !is_callable($callback)) {
            return $this->map(function ($carry) use ($callback) {
                foreach ($callback as $callable) {
                    $carry = $callable($carry);
                }

                return $carry;
            });
        }

        $keys = array_keys($this->value);
        $callback = Callables::makeInjectable($callback);
        try {
            $items = array_map($callback, $this->value, $keys);
        }
        catch (\ArgumentCountError) {
            $items = array_map($callback, $this->value);
        }

        return array_combine($keys, $items);
    }

    /**
     * Applies the $fluentMethod to the elements of the given arrays
     *
     * @param  string  $fluentMethod
     * @param  mixed  ...$arg  extra arguments passed to callback
     * @return array
     * @TODO to get better autosuggestion use phpstorm meta
     */
    public function mapMe(string $fluentMethod, mixed...$arg): array
    {
        return $this->map("flu::$fluentMethod", ...$arg);
    }


    /**
     * Run an associative map over each of the items.
     * The callback should return an associative array with a single key/value pair.
     *
     * @param  (callable(TKey,TValue): mixed)  $callback
     * @return array
     */
    public function mapWithKeys(callable $callback): array
    {
        $callback = Callables::makeInjectable($callback);
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