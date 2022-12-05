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
     * @aliasof FluentImmutableValue::toFilename()
     * @param  string  $extension
     * @return string
     */
    public function filename(string $extension): string
    {
        return Str::finish(
            $this->value,
            Str::start($extension, '.')
        );
    }

    protected static function getPathRoot(string $root = null): string
    {
        return is_null($root) ? '/' : $root;
    }

    /**
     * Convert value to path
     *
     * @example flu('filename').toFilePath('.txt','/var/www/html') #=> /var/www/html/filename.txt
     * @example flu('filename').toFilePath('txt','/var/www/html') #=> /var/www/html/filename.txt
     * @param  string|null  $extension  if null then current value is added
     * @param  string|null  $root  directory path - If null then / is used
     * @aliasof FluentImmutableValue::toPath()
     * @uses FluentImmutableValue::$path
     * @return string
     */
    public function path(string $extension = null, string $root = null): string
    {
        $root = static::getPathRoot($root);

        if (is_null($extension)) {
            return Path::join($root, $this->value());
        }

        return Path::join($root, $this->filename($extension));
    }

    /**
     * Return file extension.
     * If current value is not file then try to get extension manually using string manipulations
     *
     * @aliasof FluentImmutableValue::toExtension()
     * @param  bool  $lowercase
     * @return string
     * @uses FluentImmutableValue::$extension
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
     * @final
     */
    public function isExtension(string $extension): bool
    {
        return $this->flu->extension->lower->exactly(flu($extension)->lower->trim->toString());
    }
}