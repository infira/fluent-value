<?php

namespace Infira\FluentValue\Processors\Traits;

use Infira\FluentValue\FluentValue;
use Infira\FluentValue\Processors\FluentValueProcessor;

/**
 * @mixin FluentValueProcessor
 */
trait Dates
{
    /**
     * Convert value to date formatted string using $format
     * If $format is not provided getDefaultDateFormat() is used
     *
     * @aliasof FluentImmutableValue::toFormattedDate()
     * @param  string|null  $format
     * @return string
     * @uses FluentImmutableValue::$formatDate
     */
    public function formatDate(string $format = null): string
    {
        return $this->toDate()->format(
            is_null($format) ? FluentValue::getDefaultDateFormat() : $format
        );
    }

    /**
     * Convert value to date formatted using getDefaultDateTimeFormat()
     *
     * @aliasof FluentImmutableValue::toFormattedDateTime()
     * @return string
     * @uses FluentImmutableValue::$formatDateTime
     */
    public function formatDateTime(): string
    {
        return $this->formatDate(FluentValue::getDefaultDateTimeFormat());
    }

    /**
     * Converts value to date format Y-m-d
     *
     * @aliasof FluentImmutableValue::toStandardDate()
     * @return string
     * @uses FluentImmutableValue::$formatStandardDate
     */
    public function formatStandardDate(): string
    {
        return $this->formatDate('Y-m-d');
    }

    /**
     * Converts value to date format Y-m-d H:i:s
     *
     * @aliasof FluentImmutableValue::toStandardDateTime()
     * @return string
     * @uses FluentImmutableValue::$formatStandardDateTime
     */
    public function formatStandardDateTime(): string
    {
        return $this->formatDate('Y-m-d H:i:s');
    }

    /**
     * @aliasof FluentImmutableValue::toTimestamp()
     * @return string
     * @uses FluentImmutableValue::$timestamp
     */
    public function time(): string
    {
        return $this->toDate()->getTimestamp();
    }
}