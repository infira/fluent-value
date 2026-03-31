<?php

namespace Infira\FluentValue\Processors\Traits;

use Illuminate\Support\Str;
use Infira\FluentValue\Processors\FluentValueProcessor;
use Wolo\File\File;
use Wolo\File\Path;

/**
 * @mixin FluentValueProcessor
 */
trait Files
{
    protected function normalizePath(string $root = '/', string ...$paths): string
    {
        return Path::join($root, ...$paths);
    }

    /**
     * Add .$extension to current value
     *
     * @param string $extension
     * @return string
     * @uses FluentImmutableValue::toFileName()
     */
    public function filename(string $extension): string
    {
        return Str::finish(
            $this->value,
            Str::start($extension, '.')
        );
    }

    /**
     * Convert value to path
     *
     * @example flu('filename').toFilePath('.txt','/var/www/html') #=> /var/www/html/filename.txt
     * @example flu('filename').toFilePath('txt','/var/www/html') #=> /var/www/html/filename.txt
     * @param string $root directory path - If null then / is used
     * @uses FluentImmutableValue::$path
     * @uses FluentImmutableValue::toPath()
     * @return string
     */
    public function path(string $root = '/'): string
    {
        return $this->normalizePath($root, $this->value);
    }

    /**
     * Return file extension.
     * If current value is not file then try to get extension manually using string manipulations
     *
     * @param bool $lowercase
     * @return string
     * @uses FluentImmutableValue::$extension
     * @uses FluentImmutableValue::toExtension()
     */
    public function extension(bool $lowercase = false): string
    {
        if ($this->isFile()) {
            return File::extension($this->path(), $lowercase);
        }
        $extension = $this->flu->explodeRejectEmpty('.')->last();
        if ($lowercase) {
            return $extension->lower->toString();
        }

        return $extension->toString();
    }

    public function fileExists(): bool
    {
        if (!$this->ok()) {
            return false;
        }

        return file_exists($this->path());
    }

    public function isFile(): bool
    {
        if (!$this->ok()) {
            return false;
        }

        return is_file($this->path());
    }

    public function isExtension(string $extension): bool
    {
        return $this->flu->extension->lower->exactly(flu($extension)->lower->trim->toString());
    }
}