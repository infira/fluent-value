<?php

namespace Infira\FluentValue\Contracts;

use Wolo\Contracts\UnderlyingValue;

interface Processor extends UnderlyingValue
{
    public function canExecute(string $method);

    public function execute(string $method, mixed ...$param): mixed;

    public function propertyExists(string $property): bool;

    public function getPropertyValue(string $property): mixed;

    public function canConvertToFluent(mixed $value): bool;

    public function getFluentValue(mixed $value): mixed;

    public function setValue(mixed $value): static;
}