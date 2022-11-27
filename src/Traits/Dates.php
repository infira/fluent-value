<?php

namespace Infira\FluentValue\Traits;

use Carbon\Carbon;
use Infira\FluentValue\FluentValue;

/**
 * @mixin FluentValue
 */
trait Dates
{
    /**
     * @uses static::formatDate()
     */
    public function toFormattedDate(string $format = "d.m.Y"): string
    {
        return $this->toDate()->format($format);
    }

    /**
     * @uses static::formatStandardDate()
     */
    public function toStandardDate(string $format = "Y-m-d"): string
    {
        return $this->toDate()->format($format);
    }

    /**
     * @uses static::formatStandardDateTime()
     */
    public function toStandardDateTime(string $format = "Y-m-d H:i:s"): string
    {
        return $this->toDate()->format($format);
    }

    /**
     * @uses static::time()
     */
    public function toTime(): int
    {
        return $this->toDate()->getTimestamp();
    }

    /**
     * @uses static::formatDateTime()
     */
    public function toFormattedDateTime($format = "d.m.Y H:i:s"): string
    {
        return $this->toDate()->format($format);
    }

    /**
     * @uses static::formatDateNice()
     */
    public function toFormattedDateNice(string $format = "j. F Y"): string
    {
        return $this->toDate()->format($format);
    }

    /**
     * @uses static::formatDateTimeNice()
     */
    public function toFormattedDateTimeNice(string $format = "j. F Y H:i:s"): string
    {
        return $this->toDate()->format($format);
    }

    /**
     * @uses static::formatTimeNice()
     */
    public function toFormattedTimeNice(string $format = "H:i"): string
    {
        return $this->toDate()->format($format);
    }

    public function toDate($format = null, $tz = null): Carbon
    {
        if (is_null($format)) {
            return Carbon::parse($this->value, $tz);
        }

        return Carbon::createFromFormat($format, $this->value, $tz);
    }
}