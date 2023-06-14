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
     * @param mixed ...$data - in addition to self value pass extra to make hash
     * @return string
     * @see  Hash::make()
     * @uses FluentImmutableValue::$md5
     * @aliasof FluentImmutableValue::toMd5()
     */
    public function md5(mixed ...$data): string
    {
        return $this->hash('md5', ...$data);
    }

    /**
     * Get sha1 hash
     *
     * @param mixed ...$data - in addition to self value pass extra to make hash
     * @return string
     * @see  Hash::make()
     * @uses FluentImmutableValue::$sha1
     * @aliasof FluentImmutableValue::toSha1()
     */
    public function sha1(mixed ...$data): string
    {
        return $this->hash('sha1', ...$data);
    }

    /**
     * Get crc32b hash
     *
     * @param mixed ...$data - in addition to self value pass extra to make hash
     * @return string
     * @see  Hash::make()
     * @uses FluentImmutableValue::$crc32b
     * @aliasof FluentImmutableValue::toCrc32b()
     */
    public function crc32b(mixed ...$data): string
    {
        return $this->hash('crc32b', ...$data);
    }

    /**
     * Get sha512 hash
     *
     * @param mixed ...$data - in addition to self value pass extra to make hash
     * @return string
     * @see  Hash::make()
     * @uses FluentImmutableValue::$sha512
     * @aliasof FluentImmutableValue::toSha512()
     */
    public function sha512(mixed ...$data): string
    {
        return $this->hash('sha512', ...$data);
    }

    /**
     * Make hash from current value
     * @param string $algo
     * @param mixed ...$data - in addition to self value pass extra to make hash
     * @return string
     * @link https://www.php.net/manual/en/function.hash-algos.php
     * @link https://www.php.net/manual/en/function.hash.php
     * @aliasof FluentImmutableValue::toHash()
     */
    public function hash(string $algo, mixed ...$data): string
    {
        return Hash::make($algo, $this->value, ...$data);
    }
}