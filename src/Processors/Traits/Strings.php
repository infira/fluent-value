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
     * Get string length
     *
     * @return string
     * @uses FluentImmutableValue::$strlen
     */
    public function strlen(): string
    {
        return mb_strlen($this->value);
    }

    /**
     * Returns trailing name component of path/class-string
     *
     * @return string
     * @see  Flu::basename
     * @uses FluentImmutableValue::$basename
     */
    public function basename(): string
    {
        return Flu::basename($this->value);
    }

    /**
     * URL-encodes string
     *
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
     * @example flu('value')->wrap('value','{','}') // "{value}"
     * @example flu('value')->wrap('value',['{','}']) //"{value}"
     * @example flu('value')->wrap('value',['{','['],['}',']']) // "[{value}]"
     * @param  string|array  $before
     * @param  string|array|null  $after
     * @return string
     */
    public function wrap(string|array $before, string|array $after = null): string
    {
        return Flu::wrap($this->value, $before, $after);
    }

    /**
     * Return a formatted string
     *
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

        return vsprintf($format, $values);
    }

    /**
     * Returns the JSON representation of a value
     *
     * @param  bool  $pretty  JSON_PRETTY_PRINT - https://www.php.net/manual/en/json.constants.php
     * @return string
     * @throws \JsonException
     * @uses FluentImmutableValue::$json
     */
    public function json(bool $pretty = false): string
    {
        return Flu::json($this->value, $pretty);
    }

    /**
     * Returns the JSON representation of a value
     *
     * @param  bool|null  $associative
     * @param  int  $depth
     * @param  int  $flags
     * @return mixed
     * @uses FluentImmutableValue::$jsonDecode
     */
    public function jsonDecode(?bool $associative = null, int $depth = 512, int $flags = 0): mixed
    {
        return json_decode($this->value, $associative, $depth, $flags);
    }

    /**
     * Return a formatted string
     *
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
     * Wrap quotes
     *
     * @example flu('hello world')->wrapQuotes('"') // '"hello world"'
     * @param  string  $quotes
     * @return string
     * @uses FluentImmutableValue::$wrapQuotes
     */
    public function wrapQuotes(string $quotes = '"'): string
    {
        return $this->flu->wrap($quotes)->toString();
    }

    /**
     * Quote string with slashes
     *
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
     * @uses FluentImmutableValue::$unserialized
     */
    public function unserialize(array $options = []): mixed
    {
        return unserialize($this->value, $options);
    }

    /**
     * Get array of its characters
     *
     * @param  int  $length
     * @return array
     * @uses FluentImmutableValue::$characters - transform underlying value characters array
     */
    public function characters(int $length = 1): array
    {
        return (array)mb_str_split($this->value, $length);
    }

    protected function withRenderProcessor(callable $processor): static
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
    public function render(array $data = [], callable $renderer = null): string
    {
        if ($renderer) {
            return $renderer($this->value, $data);
        }
        if ($this->templateProcessor) {
            return ($this->templateProcessor)($this->value, $data);
        }

        return Flu::render($this->value, $data);
    }
}