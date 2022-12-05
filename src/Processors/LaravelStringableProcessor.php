<?php

namespace Infira\FluentValue\Processors;

use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;

class LaravelStringableProcessor extends Stringable implements Processor
{
    public function canExecute(string $method): bool
    {
        return method_exists($this, $method);
    }

    public function execute(string $method, mixed ...$param): mixed
    {
        return $this->$method(...$param);
    }

    public function propertyExists(string $property): bool
    {
        return $this->canExecute($property);
    }

    public function getPropertyValue(string $property): mixed
    {
        return $this->execute($property);
    }

    public function canConvertToFluent(mixed $value): bool
    {
        return $value instanceof self
            || $value instanceof Collection
            ;
    }

    public function getFluentValue(mixed $value): mixed
    {
        if ($value instanceof self) {
            return $value->toString();
        }
        if ($value instanceof Collection) {
            return $value->toArray();
        }

        return $value;
    }

    public function getValue(): mixed
    {
        return $this->value();
    }

    public function setValue(mixed $value): static
    {
        $this->value = (string)$value;

        return $this;
    }
}
