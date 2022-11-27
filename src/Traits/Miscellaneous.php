<?php

namespace Infira\FluentValue\Traits;

use Infira\FluentValue\Flu;
use Infira\FluentValue\FluentValue;
use Wolo\VarDumper;

/**
 * @uses FluentValue
 * @mixin CastingMutators
 */
trait Miscellaneous
{
    //region php keywords && miscellaneous php built int

    /**
     * Get the underlying string value as a boolean.
     * Returns true when value is "1", "true", "on", and "yes". Otherwise, returns false.
     * @link https://www.php.net/manual/en/function.filter-var.php
     * @uses static::bool()
     */
    public function toBool(): bool
    {
        if ($this->isString()) {
            return filter_var(trim($this->value), FILTER_VALIDATE_BOOLEAN);
        }

        return (bool)$this->value;
    }

    /**
     * @uses static::int()
     */
    public function toInt(): int
    {
        if ($this->isString()) {
            return (int)trim($this->value);
        }

        return (int)$this->value;
    }

    /**
     * @uses static::float()
     */
    public function toFloat(): int
    {
        return (float)$this->value;
    }

    /**
     * @uses static::array()
     */
    public function toArray(): array
    {
        return (array)$this->value;
    }

    /**
     * @uses static::string()
     */
    public function toString(): string
    {
        return (string)$this->value;
    }

    /**
     * Get the type of variable
     * @link https://php.net/manual/en/function.gettype.php
     * @uses static::type()
     */
    public function toType(): string
    {
        return gettype($this->value);
    }

    //endregion

    /**
     * String representation of object.
     * @link https://www.php.net/manual/en/function.serialize.php
     * @return string|null The string representation of the object or null
     * @uses static::serialize()
     */
    public function toSerialize(): ?string
    {
        return serialize($this->value);
    }

    /**
     * Constructs the object.
     * @link https://www.php.net/manual/en/function.unserialize.php
     * @param  array  $options
     * @return mixed
     */
    public function toUnSerialize(array $options = []): mixed
    {
        return unserialize($this->value, $options);
    }

    public function clone(): static
    {
        return clone $this;
    }

    public function debug(): void
    {
        VarDumper::debug([
            'value' => $this->value,
            'attributes' => $this->getAttributes()
        ]);
    }

    public function dump(): string
    {
        return VarDumper::dump([
            'value' => $this->value,
            'attributes' => $this->getAttributes()
        ]);
    }

    public function pre(): string
    {
        return VarDumper::pre($this->dump());
    }

    /**
     * @uses static::at()
     */
    public function getAt(int $index): mixed
    {
        return $this->value[$index];
    }

    public function toObject(string $class = null): object
    {
        if ($class === null) {
            return new $class($this->toString());
        }

        return (object)$this->value;
    }

    /**
     * @param  callable  $callback  ($value,...$parameter)
     * @param  mixed  ...$parameter
     * @return mixed
     * @uses static::transform()
     */
    public function to(callable $callback, mixed ...$parameter): mixed
    {
        return $callback($this->value, ...$parameter);
    }


    /**
     * @param  callable  $callback  ($value,...$parameter)
     * @param  mixed  ...$parameter
     * @return mixed
     * @uses static::transform()
     */
    public function callSpread(callable $callback, mixed ...$parameter): mixed
    {
        return $callback(...$this->value, ...$parameter);
    }

    public function withRenderProcessor(callable $processor): static
    {
        $this->templateProcessor = $processor;

        return $this;
    }

    public function render(array $data = []): static
    {
        if ($this->templateProcessor) {
            return $this->new(($this->templateProcessor)($this->value, $data));
        }

        return $this->new(Flu::render($this->value, $data));
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

}