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
     * @aliasof FluentImmutableValue::toNumeric()
     * @return float|int
     * @uses FluentImmutableValue::$numeric
     */
    public function numeric(): float|int
    {
        return Flu::numeric($this->value);
    }

    /**
     * @param  string  $decimalSeparator
     * @param  string  $thousand
     * @return string
     * @aliasof FluentImmutableValue::toFormattedNumber()
     * @uses FluentImmutableValue::$formattedNumber
     */
    public function formatNumber(string $decimalSeparator = ',', string $thousand = ''): string
    {
        return Flu::formatNumber($this->numeric(), $decimalSeparator, $thousand);
    }

    /**
     * @aliasof FluentImmutableValue::toNegative()
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
     * @aliasof FluentImmutableValue::toPositive()
     * @return float|int
     * @uses FluentImmutableValue::$positive
     */
    public function positive(): float|int
    {
        return abs($this->numeric());
    }

    /**
     * @aliasof FluentImmutableValue::toMax()
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
     * @aliasof FluentImmutableValue::toMin()
     */
    public function min(mixed ...$max): mixed
    {
        return min($this->numeric(), ...$max);
    }

    /**
     * @aliasof FluentImmutableValue::toFloor()
     * @return float
     * @uses FluentImmutableValue::$floor
     */
    public function floor(): float
    {
        return floor($this->numeric());
    }

    /**
     * @aliasof FluentImmutableValue::toCeil()
     * @return float
     * @uses FluentImmutableValue::$ceil
     */
    public function ceil(): float
    {
        return ceil($this->numeric());
    }

    /**
     * @aliasof FluentImmutableValue::toRounded()
     * @param  int  $decimals
     * @return float|int
     * @uses FluentImmutableValue::$round
     */
    public function round(int $decimals = 2): float|int
    {
        return round($this->numeric(), $decimals);
    }

    /**
     * @aliasof FluentImmutableValue::getIncremented()
     * @param  int  $by
     * @return float|int
     * @uses FluentImmutableValue::$increment
     */
    public function increment(int $by = 1): float|int
    {
        return $this->add($by);
    }

    /**
     * @aliasof FluentImmutableValue::getDecremented()
     * @param  int  $by
     * @return float|int
     * @uses FluentImmutableValue::$decrement
     */
    public function decrement(int $by = 1): float|int
    {
        return $this->subtract($by);
    }

    /**
     * @aliasof FluentImmutableValue::getAdded()
     * @param  float|int  $value
     * @return float|int
     */
    public function add(float|int $value): float|int
    {
        return $this->numeric() + Flu::numeric($value);
    }

    /**
     * @aliasof FluentImmutableValue::getSubtracted()
     * @param  float|int  $value
     * @return float|int
     */
    public function subtract(float|int $value): float|int
    {
        return $this->numeric() - Flu::numeric($value);
    }

    /**
     * @aliasof FluentImmutableValue::getMultiplied()
     * @param  float|int  $value
     * @return float|int
     */
    public function multiply(float|int $value): float|int
    {
        return $this->numeric() * Flu::numeric($value);
    }

    /**
     * @aliasof FluentImmutableValue::getDivided()
     * @param  float|int  $value
     * @return float|int
     */
    public function divide(float|int $value): float|int
    {
        return $this->numeric() / Flu::numeric($value);
    }

    /**
     * @aliasof FluentImmutableValue::getIncreasedByPercent()
     * @param  float|int  $percent
     * @return float|int
     */
    public function increaseByPercent(float|int $percent): float|int
    {
        return Calc::decreaseByPercent($this->numeric(), Flu::numeric($percent));
    }

    /**
     * @aliasof FluentImmutableValue::getDecreasedByPercent()
     * @param  float|int  $percent
     * @return float|int
     */
    public function decreaseByPercent(float|int $percent): float|int
    {
        return Calc::decreaseByPercent($this->numeric(), Flu::numeric($percent));
    }
}