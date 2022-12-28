<?php

namespace Infira\FluentValue\Processors\Traits;

use Wolo\Calculator\Pricing;
use Wolo\Calculator\Vat;
use Infira\FluentValue\FluentValue;
use Infira\FluentValue\Processors\FluentValueProcessor;

/**
 * @mixin FluentValueProcessor
 */
trait MoneyAndTaxes
{
    /**
     * Format value as number and append € currency sign
     *
     * @example flu(10000.50)->eur() // "10000,50€"
     * @example flu(10000.50)->eur('.',' ') // "10 000.50€"
     * @param  string  $decimalSeparator
     * @param  string  $thousand
     * @return string
     * @uses FluentImmutableValue::$eur
     */
    public function eur(string $decimalSeparator = ',', string $thousand = ''): string
    {
        return $this->money('€', $decimalSeparator, $thousand);
    }

    /**
     * Format value as number and append $ currency sign
     *
     * @example flu(10000.50)->dollar('.',' ') // "10 000.50$"
     * @example flu(10000.50)->dollar() // "10000,50$"
     * @param  string  $decimalSeparator
     * @param  string  $thousand
     * @return string
     * @uses FluentImmutableValue::$dollar
     */
    public function dollar(string $decimalSeparator = ',', string $thousand = ''): string
    {
        return $this->money('$', $decimalSeparator, $thousand);
    }

    /**
     * Format money
     *
     * @example flu(10000.50)->money('$') // "10000,50$"
     * @example flu(10000.50)->money('$','.',' ') // "10 000.50$"
     * @param  string  $thousand
     * @param  string  $currency
     * @param  string  $decimalSeparator
     * @return string
     */
    public function money(string $currency, string $decimalSeparator = ',', string $thousand = ''): string
    {
        return $this->formatNumber($decimalSeparator, $thousand).$currency;
    }

    /**
     * @param  float|int  $percent
     * @return float|int
     */
    public function discount(float|int $percent): float|int
    {
        return Pricing::discount($this->numeric(), $percent);
    }

    /**
     * Add markup to value
     *
     * @param  float|int  $percent
     * @return float|int
     */
    public function markup(float|int $percent): float|int
    {
        return Pricing::markup($this->numeric(), $percent);
    }

    /**
     * Remove VAT(value added tax) from value
     *
     * @param  float|int|null  $vatPercent
     * @return float|int
     * @uses FluentImmutableValue::$vatExcluded - FluentValue where VAT(value added tax) is excluded
     */
    public function removeVat(float|int $vatPercent = null): float|int
    {
        return Vat::remove(
            $this->numeric(),
            is_null($vatPercent) ? FluentValue::getDefaultVATPercent() : $vatPercent
        );
    }

    /**
     * Add VAT(value added tax) to value
     *
     * @param  float|int|null  $vatPercent
     * @return float|int
     * @uses FluentImmutableValue::$vatIncluded - FluentValue where VAT(value added tax) is included
     */
    public function addVat(float|int $vatPercent = null): float|int
    {
        return Vat::add(
            $this->numeric(),
            is_null($vatPercent) ? FluentValue::getDefaultVATPercent() : $vatPercent
        );
    }

    /**
     * Get VAT(value added tax) of current value
     *
     * @param  bool  $priceContainsVat
     * @param  float|int|null  $vatPercent
     * @return float|int
     */
    public function vat(bool $priceContainsVat, float|int $vatPercent = null): float|int
    {
        return Vat::get(
            $this->numeric(),
            $priceContainsVat,
            is_null($vatPercent) ? FluentValue::getDefaultVATPercent() : $vatPercent
        );
    }
}