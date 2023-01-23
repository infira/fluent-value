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
    /**
     * Add .$extension to current value
     *
     * @param  string  $extension
     * @return string
     * @aliasof FluentImmutableValue::toFileName()
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
     * @param  string|null  $extension  if null then current value is added
     * @param  string|null  $root  directory path - If null then / is used
     * @uses FluentImmutableValue::$path
     * @aliasof FluentImmutableValue::toPath()
     * @return string
     */
    public function path(string $extension = null, string $root = null): string
    {
        $root = $root ?: '/';

        if (is_null($extension)) {
            return Path::join($root, $this->value());
        }

        return Path::join($root, $this->filename($extension));
    }

    /**
     * Return file extension.
     * If current value is not file then try to get extension manually using string manipulations
     *
     * @param  bool  $lowercase
     * @return string
     * @uses FluentImmutableValue::$extension
     * @aliasof FluentImmutableValue::toExtension()
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

    /**
     * @param  string|null  $extension
     * @return bool
     * @aliasof FluentImmutableValue::fileExists()
     * @final
     */
    public function fileExists(string $extension = null): bool
    {
        if (!$this->ok()) {
            return false;
        }

        return file_exists($this->path($extension));
    }

    /**
     * @param  string|null  $extension
     * @return bool
     * @aliasof FluentImmutableValue::isFile()
     * @final
     */
    public function isFile(string $extension = null): bool
    {
        if (!$this->ok()) {
            return false;
        }

        return is_file($this->path($extension));
    }

    /**
     * Is current value file extension
     *
     * @aliasof FluentImmutableValue::isExtension()
     * @final
     */
    public function isExtension(string $extension): bool
    {
        return $this->flu->extension->lower->exactly(flu($extension)->lower->trim->toString());
    }
}