<?php

namespace Infira\FluentValue\Processors\Traits;

use Infira\FluentValue\Flu;
use Infira\FluentValue\Processors\FluentValueProcessor;
use Wolo\Calculator\Calc;

/**
 * @mixin FluentValueProcessor
 */
trait Numbers
{
    /**
     * @return float|int
     * @uses FluentImmutableValue::$numeric
     * @aliasof FluentImmutableValue::toNumeric()
     */
    public function numeric(): float|int
    {
        return Flu::numeric($this->value);
    }

    /**
     * @param  string  $decimalSeparator
     * @param  string  $thousand
     * @return string
     * @uses FluentImmutableValue::$formattedNumber
     */
    public function formatNumber(string $decimalSeparator = ',', string $thousand = ''): string
    {
        return Flu::formatNumber($this->numeric(), $decimalSeparator, $thousand);
    }

    /**
     * @return float|int
     * @uses FluentImmutableValue::$negative
     */
    public function negative(): float|int
    {
        $nr = $this->numeric();
        if ($nr < 0) {
            return $nr;
        }

        return $nr * -1;
    }

    /**
     * @return float|int
     * @uses FluentImmutableValue::$positive
     */
    public function positive(): float|int
    {
        return abs($this->numeric());
    }

    /**
     * @param  mixed  ...$max
     * @return mixed
     */
    public function max(mixed ...$max): mixed
    {
        return max($this->numeric(), ...$max);
    }

    /**
     * @param  mixed  ...$max
     * @return mixed
     */
    public function min(mixed ...$max): mixed
    {
        return min($this->numeric(), ...$max);
    }

    /**
     * @return float
     * @uses FluentImmutableValue::$floor
     */
    public function floor(): float
    {
        return floor($this->numeric());
    }

    /**
     * @return float
     * @uses FluentImmutableValue::$ceil
     */
    public function ceil(): float
    {
        return ceil($this->numeric());
    }

    /**
     * @param  int  $decimals
     * @return float|int
     * @uses FluentImmutableValue::$round
     */
    public function round(int $decimals = 2): float|int
    {
        return round($this->numeric(), $decimals);
    }

    /**
     * @param  int  $by
     * @return float|int
     * @uses FluentImmutableValue::$increment
     * @template Immutable
     */
    public function increment(int $by = 1): float|int
    {
        return $this->add($by);
    }

    /**
     * @param  int  $by
     * @return float|int
     * @uses FluentImmutableValue::$decrement
     * @template Immutable
     */
    public function decrement(int $by = 1): float|int
    {
        return $this->subtract($by);
    }

    /**
     * @param  float|int  $value
     * @return float|int
     */
    public function add(float|int $value): float|int
    {
        return $this->numeric() + Flu::numeric($value);
    }

    /**
     * @param  float|int  $value
     * @return float|int
     */
    public function subtract(float|int $value): float|int
    {
        return $this->numeric() - Flu::numeric($value);
    }

    /**
     * @param  float|int  $value
     * @return float|int
     */
    public function multiply(float|int $value): float|int
    {
        return $this->numeric() * Flu::numeric($value);
    }

    /**
     * @param  float|int  $value
     * @return float|int
     */
    public function divide(float|int $value): float|int
    {
        return $this->numeric() / Flu::numeric($value);
    }

    /**
     * @param  float|int  $percent
     * @return float|int
     */
    public function increaseByPercent(float|int $percent): float|int
    {
        return Calc::decreaseByPercent($this->numeric(), Flu::numeric($percent));
    }

    /**
     * @param  float|int  $percent
     * @return float|int
     */
    public function decreaseByPercent(float|int $percent): float|int
    {
        return Calc::decreaseByPercent($this->numeric(), Flu::numeric($percent));
    }
}