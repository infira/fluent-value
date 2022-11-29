<?php

namespace Infira\FluentValue\Traits;

use Illuminate\Support\Str;
use Infira\FluentValue\FluentValue;
use Wolo\File\File;
use Wolo\File\Path;

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

        return file_exists($this->toPath($extension));
    }

    public function isFile(string $extension = null): bool
    {
        if (!$this->ok()) {
            return false;
        }

        return is_file($this->toPath($extension));
    }

    /**
     * Add .$extension to current value
     * @uses static::filename()
     */
    public function toFilename(string $extension): string
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
     * @example flu('filename').toFilePath('.txt','/var/www/html') #=> /var/www/html/filename.txt
     * @example flu('filename').toFilePath('txt','/var/www/html') #=> /var/www/html/filename.txt
     * @param  string|null  $extension  if null then current value is added
     * @param  string|null  $root  directory path - If null then / is used
     * @uses static::path()
     */
    public function toPath(string $extension = null, string $root = null): string
    {
        $root = static::getPathRoot($root);

        if (is_null($extension)) {
            return Path::join($root, $this->value());
        }

        return Path::join($root, $this->toFilename($extension));
    }

    /**
     * Return file extension.
     * If current value is not file then try to get extension manually using string manipulations
     * @uses static::extension()
     */
    public function toExtension(bool $lowercase = false): string
    {
        if ($this->isFile()) {
            return File::extension($this->toPath(), $lowercase);
        }
        $extension = $this->explodeRejectEmpty('.')->last();
        if ($lowercase) {
            return $extension->lower->toString();
        }

        return $extension->toString();
    }


    /**
     * Is current value file extension
     */
    public function isExtension(string $extension): bool
    {
        return $this->extension->lower->exactly(flu($extension)->lower->trim->toString());
    }
}