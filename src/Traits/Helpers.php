<?php

namespace Infira\FluentValue\Traits;

use Carbon\Carbon;
use Infira\FluentValue\FluentChain;
use Wolo\Closure;
use Wolo\VarDumper;

/**
 * @template TValue
 */
trait Helpers
{
    public function clone(): static
    {
        return clone $this;
    }

    /**
     * Pass the $this to the given callback
     *
     * @param  callable($this): mixed  $callback
     * @return $this
     */
    public function tap(callable $callback): static
    {
        $callback($this);

        return $this;
    }

    public function debug(): void
    {
        VarDumper::debug([
            'value' => $this->get(),
            'attributes' => $this->getAttributes()
        ]);
    }

    public function dump(): string
    {
        return VarDumper::dump([
            'value' => $this->get(),
            'attributes' => $this->getAttributes()
        ]);
    }

    public function pre(): string
    {
        return VarDumper::pre($this->dump());
    }

    /**
     * execute a callback over each item.
     */
    public function each(callable $callback): static
    {
        $callback = Closure::makeInjectableOrVoid($callback);
        foreach ($this->get() as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    /**
     * @param  callable  $callback  ($value,...$parameter)
     * @param  mixed  ...$parameter
     * @return mixed
     */
    public function to(callable $callback, mixed ...$parameter): mixed
    {
        return $callback($this->value, ...$parameter);
    }

    /**
     * @param  class-string|null  $class
     * @return object
     */
    public function toObject(string $class = null): object
    {
        if ($class === null) {
            return new $class($this);
        }

        return (object)$this->value;
    }

    public function toDate($format = null, $tz = null): Carbon
    {
        if (is_null($format)) {
            return Carbon::parse($this->value, $tz);
        }

        return Carbon::createFromFormat($format, $this->value, $tz);
    }

    //region chaining
    public function chain(self $carry = null): FluentChain
    {
        return new FluentChain($carry ?: $this);
    }

    public function whenOkChain(mixed $failedValue = null): FluentChain
    {
        if (func_num_args() === 0) {
            return $this->chain($this)->dontRunWhen(fn() => $this->notOk());
        }

        return $this->chain($this)->dontRunWhen(fn() => $this->notOk(), $failedValue);
    }
    //endregion
}