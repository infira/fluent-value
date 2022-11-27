<?php

namespace Infira\FluentValue\Traits;

use Infira\FluentValue\FluentValue;

/**
 * @mixin FluentValue
 */
trait PHPBuiltInterfaceImplementations
{
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->value[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->value[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->value[$offset]);
    }

    public function count(): int
    {
        return count($this->value);
    }

    public function length(): int
    {
        return strlen($this->value);
    }
}