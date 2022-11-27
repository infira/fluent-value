<?php

namespace Infira\FluentValue\Traits;

use Illuminate\Support\Str;
use Infira\FluentValue\FluentValue;

/**
 * @mixin FluentValue
 */
trait Files
{
    public function fileExists(string $extension = null): bool
    {
        if (!$this->ok()) {
            return false;
        }

        return file_exists($this->toFilename($extension));
    }

    /**
     * Add .$extension to current value
     * @uses static::filename()
     */
    public function toFilename(?string $extension): string
    {
        if (!$extension) {
            return (string)$this->value;
        }

        return $this->toFormatted('{%value%}'.Str::start($extension, '.'));
    }
}