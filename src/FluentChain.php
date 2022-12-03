<?php

namespace Infira\FluentValue;

/**
 * @mixin FluentValue
 */
class FluentChain
{
    private array $callables = [];
    private bool $brakes = false;
    private bool $dontStartRunning = false;
    private mixed $carry;
    private string $fluentClass;

    public function __construct(public FluentValue $fluentValue)
    {
        $this->carry = $this->fluentValue;
        $this->fluentClass = $this->fluentValue::class;
    }

    public function __call(string $name, array $arguments)
    {
        $this->callables[] = [$name, $arguments];

        return $this;
    }

    public function __invoke()
    {
        return $this->run();
    }

    public function __toString(): string
    {
        return $this->run()->toString();
    }

    public function __debugInfo(): ?array
    {
        return [$this->callables];
    }

    public function run(): FluentValue
    {
        if (!$this->dontStartRunning) {
            foreach ($this->callables as $callable) {
                [$method, $arguments] = $callable;
                $this->carry = $this->carry->$method(...$arguments);
                if (!$this->carry instanceof FluentValue) {
                    break;
                }
                if ($this->brakes) {
                    break;
                }
            }
        }

        return new ($this->fluentClass)($this->carry);
    }

    public function dontRunWhen(callable $condtion, mixed $output = null): static
    {
        $this->dontStartRunning = $this->_isBreake($condtion);
        if (func_num_args() > 1) {
            $this->carry = $output;
        }

        return $this;
    }

    public function brake(mixed $condition): static
    {
        $this->brakes = $this->_isBreake($condition);

        return $this;
    }

    private function _isBreake(mixed $condition): bool
    {
        return (bool)($condition instanceof \Closure ? $condition($this->fluentValue) : $condition);
    }
}