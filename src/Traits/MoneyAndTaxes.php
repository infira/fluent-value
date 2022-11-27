<?php

namespace Infira\FluentValue\Traits;

use Wolo\Calculator\Pricing;
use Wolo\Calculator\Vat;
use Infira\FluentValue\FluentValue;

/**
 * @mixin FluentValue
 */
trait MoneyAndTaxes
{
    /**
     * returns $value€
     * @uses static::eur()
     */
    public function toEur(): string
    {
        return $this->toMoney('€');
    }

    /**
     * Format money
     * @uses static::money()
     */
    public function toMoney(string $currency, string $decimalSeparator = ',', string $thousand = ''): string
    {
        return $this->toFormattedNumber($decimalSeparator, $thousand).$currency;
    }

    /**
     * @uses static::discount()
     */
    public function getWithDiscount(float $percent = 0): float|int
    {
        return Pricing::discount($this->value, $percent);
    }

    /**
     * @uses static::markup()
     */
    public function getWithMarkup(float $percent = 0): float|int
    {
        return Pricing::markup($this->value, $percent);
    }

    /**
     * @uses static::removeVat()
     */
    public function getVatExcluded(float $vatPercent = null): float|int
    {
        return Vat::remove($this->value, $vatPercent);
    }

    /**
     * @uses static::addVat()
     */
    public function getVatIncluded(float $vatPercent = null): float|int
    {
        return Vat::add($this->value, $vatPercent);
    }

    /**
     * Get VAT(value added tax) of current value
     * @uses static::vat()
     */
    public function getVatOf(bool $priceContainsVat, float $vatPercent = null): float|int
    {
        return Vat::get(
            $this->value,
            $priceContainsVat,
            $vatPercent
        );
    }
}