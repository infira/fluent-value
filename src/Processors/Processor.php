<?php

namespace Infira\FluentValue\Processors;

interface Processor
{
    public function canExecute(string $method);

    public function execute(string $method, mixed ...$param): mixed;

    public function propertyExists(string $property): bool;

    public function getPropertyValue(string $property): mixed;

    public function canConvertToFluent(mixed $value): bool;

    public function getFluentValue(mixed $value): mixed;

    public function getValue(): mixed;

    public function setValue(mixed $value): static;
}