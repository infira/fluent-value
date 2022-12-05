<?php

namespace Infira\FluentValue\Processors\Traits;

use Infira\FluentValue\Processors\FluentValueProcessor;
use Wolo\Hash;

/**
 * @mixin FluentValueProcessor
 */
trait Hashing
{
    /**
     * Get md5 hash
     *
     * @return string
     * @see  Hash::make()
     * @aliasof FluentImmutableValue::toMd5()
     * @uses FluentImmutableValue::$md5
     */
    public function md5(): string
    {
        return Hash::md5($this->value);
    }

    /**
     * Get sha1 hash
     *
     * @return string
     * @see  Hash::make()
     * @aliasof FluentImmutableValue::toSha1()
     * @uses FluentImmutableValue::$sha1
     */
    public function sha1(): string
    {
        return Hash::sha1($this->value);
    }

    /**
     * Get crc32b hash
     *
     * @return string
     * @see  Hash::make()
     * @aliasof FluentImmutableValue::toCrc32b()
     * @uses FluentImmutableValue::$crc32b
     */
    public function crc32b(): string
    {
        return Hash::crc32b($this->value);
    }

    /**
     * Get sha512 hash
     *
     * @return string
     * @see  Hash::make()
     * @aliasof FluentImmutableValue::toSha512()
     * @uses FluentImmutableValue::$sha512
     */
    public function sha512(): string
    {
        return Hash::sha512($this->value);
    }
}