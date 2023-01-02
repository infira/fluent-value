<?php

namespace Infira\FluentValue\Chain;

use Infira\FluentValue\FluentValue;
use Wolo\Contracts\UnderlyingValue;

/**
 * @property-read FluentValue $end - ends chain
 */
class FluentChain implements \Stringable, UnderlyingValue
{
    private array $callables = [];
    private bool $brakes = false;
    private bool $dontStartRunning = false;
    private mixed $carry;
    use FluentChainIdeHelper;
    use \Infira\FluentValue\Processors\Traits\Types;

    public function __construct(protected FluentValue $flu)
    {
        $this->carry = $this->flu;
    }

    public function __call(string $name, array $arguments)
    {
        $this->callables[] = [$name, $arguments];

        return $this;
    }

    public function __invoke(): FluentValue
    {
        return $this->run();
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function __get(string $name)
    {
        if ($name === 'end') {
            return $this->run();
        }

        return $this;
    }

    public function value(): mixed
    {
        return $this->run()->value();
    }

    public function __debugInfo(): ?array
    {
        return [$this->callables];
    }

    public function run(): FluentValue
    {
        if ($this->dontStartRunning) {
            return $this->flu->new($this->carry);
        }

        return $this->reduceCallables($this->carry);
    }

    protected function reduceCallables(FluentValue $carry): FluentValue
    {
        foreach ($this->callables as $callable) {
            [$method, $arguments] = $callable;
            $carry = $carry->$method(...$arguments);
            if (!$carry instanceof FluentValue || $this->brakes) {
                break;
            }
        }

        return $this->flu->new($carry);
    }


    public function dontRunWhen(callable $condition, mixed $output = null): static
    {
        $this->dontStartRunning = $this->_isBreake($condition);
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
        return (bool)($condition instanceof \Closure ? $condition($this->flu) : $condition);
    }
}