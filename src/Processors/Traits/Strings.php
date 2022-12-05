<?php

namespace Infira\FluentValue\Processors\Traits;

use Infira\FluentValue\Flu;
use Infira\FluentValue\Processors\FluentValueProcessor;
use Wolo\Regex;

/**
 * @mixin FluentValueProcessor
 */
trait Strings
{
    /**
     * @var callable
     */
    private $templateProcessor;

    /**
     * Returns trailing name component of path/class-string
     *
     * @return string
     * @see  Flu::basename
     * @aliasof FluentImmutableValue::toBaseName()
     * @uses FluentImmutableValue::$basename
     */
    public function basename(): string
    {
        return Flu::basename($this->value);
    }

    /**
     * URL-encodes string
     *
     * @aliasof FluentImmutableValue::toEncodedURL()
     * @return string
     * @uses FluentImmutableValue::$encodedURL
     */
    public function urlEncode(): string
    {
        return urlencode($this->value);
    }

    /**
     * Join array elements with a string
     *
     * @aliasof FluentImmutableValue::toImploded()
     * @param  string  $glue
     * @return string
     */
    public function implode(string $glue): string
    {
        return implode($glue, $this->value);
    }

    /**
     * Join array elements with a string
     *
     * @alias self::implode
     * @param  string  $glue
     * @return string
     */
    public function join(string $glue): string
    {
        return $this->implode($glue);
    }

    /**
     * Split a string by a string
     *
     * @aliasof FluentImmutableValue::toExploded()
     * @param  string  $separator
     * @return array
     */
    public function explode(string $separator): array
    {
        return explode($separator, (string)$this->value);
    }

    /**
     * Split lines into array
     *
     * @aliasof FluentImmutableValue::toLines()
     * @return array
     * @uses FluentImmutableValue::$lines
     */
    public function lines(): array
    {
        return $this->explode(PHP_EOL);
    }

    /**
     * Surround value with
     *
     * @aliasof FluentImmutableValue::toSurrounded()
     * @example flu('value')->surround('{}') // {value}
     * @example flu('value')->surround('left_','_right') // left_value_right
     * @example flu('value')->surround(['left_','_right']) // left_value_right
     * @param  string|array  $wrap
     * @param  string|null  $right
     * @return string
     */
    public function surround(string|array $wrap, string $right = null): string
    {
        return Flu::surround($this->value, $wrap, $right);
    }

    /**
     * Return a formatted string
     *
     * @aliasof FluentImmutableValue::toFormatted()
     * @example flu('gen')->getFormattedText('my name is {%value%}, and im %s age of old',39) //my name is gen, and im 39 age of old
     * @param  string  $format
     * @param  mixed  ...$values
     * @return string
     */
    public function format(string $format, mixed ...$values): string
    {
        $format = str_replace('{%value%}', $this->value, $format);
        if (!$values) {
            return $format;
        }

        return vsprintf($this->value, $values);
    }

    /**
     * Returns the JSON representation of a value
     *
     * @param  bool  $pretty  JSON_PRETTY_PRINT - https://www.php.net/manual/en/json.constants.php
     * @return string
     * @throws \JsonException
     * @aliasof FluentImmutableValue::toEncodedJson()
     * @uses FluentImmutableValue::$json
     */
    public function json(bool $pretty = false): string
    {
        return Flu::json($this->value, $pretty);
    }

    /**
     * Return a formatted string
     *
     * @aliasof FluentImmutableValue::toSprintf()
     * @param  mixed  ...$values
     * @return string
     */
    public function sprintf(mixed ...$values): string
    {
        return $this->vsprintf($values);
    }

    /**
     * Return a formatted string
     *
     * @aliasof FluentImmutableValue::toVSprintf()
     * @param  mixed  $values
     * @return string
     */
    public function vsprintf(mixed $values): string
    {
        if (!$values) {
            return $this->toString();
        }

        return vsprintf($this->value, $values);
    }

    /**
     * Quote string with slashes
     *
     * @aliasof FluentImmutableValue::toSlashedString()
     * @return string
     * @uses FluentImmutableValue::$slashedString
     */
    public function addSlashes(): string
    {
        return addslashes($this->value);
    }

    /**
     * Parses the string into variables
     *
     * @aliasof FluentImmutableValue::toParseStr()
     * @return array
     * @uses FluentImmutableValue::$parsedStr
     */
    public function parseStr(): array
    {
        if ($this->isArray()) {
            return $this->value;
        }

        return Flu::parseStr($this->value);
    }

    /**
     * Get the string matching the given pattern.
     *
     * @param  string  $pattern
     * @return string
     * @see  Regex::match()
     * @aliasof FluentImmutableValue::getMatch()
     */
    public function match(string $pattern): string
    {
        return Regex::match($pattern, $this->value);
    }

    /**
     * Get the string matching the given pattern.
     *
     * @param  string  $pattern
     * @return array
     * @see  Regex::matchAll
     * @aliasof FluentImmutableValue::getAllMatches()
     */
    public function matchAll(string $pattern): array
    {
        return Regex::matchAll($pattern, $this->value);
    }

    /**
     * String representation of object.
     *
     * @return string|null The string representation of the object or null
     * @aliasof FluentImmutableValue::toSerialized()
     * @uses FluentImmutableValue::$serialized
     */
    public function serialize(): ?string
    {
        return serialize($this->value);
    }

    /**
     * Constructs the object.
     *
     * @param  array  $options
     * @return mixed
     * @aliasof FluentImmutableValue::toUnserialized()
     * @uses FluentImmutableValue::$unserialized
     */
    public function unserialize(array $options = []): mixed
    {
        return unserialize($this->value, $options);
    }

    /**
     * Get array of its characters
     *
     * @aliasof FluentImmutableValue::getCharacters()
     * @param  int  $length
     * @return array
     * @uses FluentImmutableValue::$characters - transform underlying value characters array
     */
    public function characters(int $length = 1): array
    {
        return (array)mb_str_split($this->value, $length);
    }

    public function withRenderProcessor(callable $processor): static
    {
        $this->templateProcessor = $processor;

        return $this;
    }

    /**
     * Simple string templating
     *
     * @example flu('my name is {name}')->render(['name' => 'gen']) // 'my name is gen'
     * @uses FluentImmutableValue::$rendered
     * @param  array  $data
     * @return string
     */
    public function render(array $data = []): string
    {
        if ($this->templateProcessor) {
            return ($this->templateProcessor)($this->value, $data);
        }

        return Flu::render($this->value, $data);
    }
}