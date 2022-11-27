<?php

namespace Infira\FluentValue\Traits;

use Infira\FluentValue\FluentValue;
use Wolo\Hash;

/**
 * @mixin FluentValue
 */
trait Hashing
{
    /**
     * @see  Hash::make()
     * @uses static::md5()
     */
    public function toMd5(): string
    {
        return Hash::md5($this->value);
    }

    /**
     * @see  Hash::make()
     * @uses static::sha1()
     */
    public function toSha1(): string
    {
        return Hash::sha1($this->value);
    }

    /**
     * @see  Hash::make()
     * @uses static::crc32b()
     */
    public function toCrc32b(): string
    {
        return Hash::crc32b($this->value);
    }

    /**
     * @see  Hash::make()
     * @uses static::sha512()
     */
    public function toSha512(): string
    {
        return Hash::sha512($this->value);
    }
}