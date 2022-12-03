<?php

namespace Infira\FluentValue\Traits;

use Infira\FluentValue\Flu;
use Infira\FluentValue\FluentValue;
use Wolo\Regex;

/**
 * @mixin FluentValue
 */
trait Strings
{
    /**
     * Returns trailing name component of path/class-string
     * @see  Flu::basename
     * @uses static::basename()
     */
    public function toBasename(): string
    {
        return Flu::basename($this->value);
    }

    /**
     * URL-encodes string
     * @link https://php.net/manual/en/function.urlencode.php
     * @uses static::urlEncode()
     */
    public function toEncodedURL(): string
    {
        return urlencode($this->value);
    }

    /**
     * Join array elements with a string
     * @link https://php.net/manual/en/function.implode.php
     * @uses static::join()
     */
    public function toImploded(string $glue): string
    {
        return implode($glue, $this->value);
    }

    /**
     * Split a string by a string
     * @link https://php.net/manual/en/function.explode.php
     * @uses static::explode
     */
    public function toExploded(string $separator): array
    {
        return explode($separator, (string)$this->value);
    }

    /**
     * Split lines into array
     * @uses static::lines
     */
    public function toLines(): array
    {
        return $this->toExploded(PHP_EOL);
    }

    /**
     * Surround value with
     * @example flu('value')->surround('{}') // {value}
     * @example flu('value')->surround('left_','_right') // left_value_right
     * @example flu('value')->surround(['left_','_right']) // left_value_right
     */
    public function surround(string|array $wrap, string $right = null): static
    {
        return $this->new(Flu::surround($this->value, $wrap, $right));
    }

    /**
     * Return a formatted string
     * @uses static::format()
     * @example flu('gen')->getFormattedText('my name is {%value%}, and im %s age of old',39) //my name is gen, and im 39 age of old
     */
    public function toFormatted(string $format, mixed ...$values): string
    {
        $format = str_replace('{%value%}', $this->value, $format);
        if (!$values) {
            return $format;
        }

        return vsprintf($this->value, $values);
    }

    /**
     * Returns the JSON representation of a value
     * @param  bool  $pretty  JSON_PRETTY_PRINT - https://www.php.net/manual/en/json.constants.php
     * @return string
     * @link https://php.net/manual/en/function.json-encode.php
     * @throws \JsonException
     * @uses static::json()
     */
    public function toEncodedJson(bool $pretty = false): string
    {
        return Flu::json($this->value, $pretty);
    }

    /**
     * Return a formatted string
     * @link @link https://php.net/manual/en/function.sprintf.php
     * @uses static::sprintf()
     */
    public function toSprintf(mixed ...$values): string
    {
        return $this->toVSprintf($values);
    }

    /**
     * Return a formatted string
     * @link @link https://php.net/manual/en/function.vsprintf.php
     * @uses static::vsprintf()
     */
    public function toVSprintf(mixed $values): string
    {
        if (!$values) {
            return $this->toString();
        }

        return vsprintf($this->value, $values);
    }

    /**
     * Quote string with slashes
     * @link https://php.net/manual/en/function.addslashes.php
     * @uses static::addSlashes()
     */
    public function toSlashedString(): string
    {
        return addslashes($this->value);
    }

    /**
     * Parses the string into variables
     * @link https://www.php.net/manual/en/function.parse-str.php
     * @uses static::parseStr()
     */
    public function toParseStr(): array
    {
        if ($this->isArray()) {
            return $this->value;
        }

        return Flu::parseStr($this->value);
    }

    /**
     * Get the string matching the given pattern.
     * @see  Regex::matchAll
     * @uses static::matchAll
     */
    public function getAllMatches(string $pattern): array
    {
        return Regex::matchAll($pattern, $this->value);
    }
}