<?php

namespace Infira\FluentValue\Traits;

use Wolo\Calculator\Calc;
use Infira\FluentValue\Flu;
use Infira\FluentValue\FluentValue;

/**
 * @uses FluentValue
 */
trait Numbers
{
    /**
     * @uses static::numeric()
     */
    public function toNumeric(): float|int
    {
        return Flu::numeric($this->value);
    }

    /**
     * @uses static::formatNumber()
     */
    public function toFormattedNumber(string $decimalSeparator = ',', string $thousand = ''): string
    {
        return Flu::formatNumber($this->value, $decimalSeparator, $thousand);
    }

    /**
     * @uses static::negative()
     */
    public function toNegative(): float|int
    {
        $nr = $this->toNumeric();
        if ($nr < 0) {
            return $nr;
        }

        return $nr * -1;
    }

    /**
     * @uses static::positive()
     */
    public function toPositive(): float|int
    {
        return abs($this->toNumeric());
    }

    /**
     * @uses static::max()
     */
    public function toMax(mixed ...$max): mixed
    {
        return max($this->value, ...$max);
    }

    /**
     * @uses static::min()
     */
    public function toMin(mixed ...$max): mixed
    {
        return min($this->value, ...$max);
    }

    /**
     * @uses static::floor()
     */
    public function toFloor(): float|int
    {
        return floor($this->toNumeric());
    }

    /**
     * @uses static::ceil()
     */
    public function toCeil(): float|int
    {
        return ceil($this->toNumeric());
    }

    /**
     * @uses static::round()
     */
    public function toRounded(int $decimals = 2): float|int
    {
        return round($this->value, $decimals);
    }

    public function increment(int $by = 1): static
    {
        return $this->add($by);
    }

    public function decrement(int $by = 1): static
    {
        return $this->subtract($by);
    }

    public function add(float|int $value): static
    {
        return $this->new(Flu::numeric($this->value) + Flu::numeric($value));
    }

    public function subtract(float|int $value): static
    {
        return $this->new(Flu::numeric($this->value) - Flu::numeric($value));
    }

    public function multiply(float|int $value): static
    {
        return $this->new(Flu::numeric($this->value) * Flu::numeric($value));
    }

    public function divide(float|int $value): static
    {
        return $this->new(Flu::numeric($this->value) / Flu::numeric($value));
    }

    public function increaseByPercent(float|int $percent): static
    {
        return $this->new(Calc::decreaseByPercent($this->value, Flu::numeric($percent)));
    }

    public function decreaseByPercent(float|int $percent): static
    {
        return $this->new(Calc::decreaseByPercent($this->value, Flu::numeric($percent)));
    }
}