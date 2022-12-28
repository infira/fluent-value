<?php

namespace Infira\FluentValue;

use JsonException;
use Wolo\Traits\NumberTrait;
use Wolo\Traits\StringTrait;

class Flu
{
    use StringTrait;
    use NumberTrait;

    /**
     * @see flu()
     * @var class-string
     */
    public static string $defaultFluentValueClass = FluentValue::class;

    public static function of(mixed $value, array $attributes = []): FluentValue
    {
        return (new (static::$defaultFluentValueClass)($value))->setAttributes($attributes);
    }

    //region string related

    /**
     * Returns the JSON representation of a value
     *
     * @param  mixed  $input
     * @param  bool  $pretty  JSON_PRETTY_PRINT - https://www.php.net/manual/en/json.constants.php
     * @return string
     * @throws JsonException
     * @link https://php.net/manual/en/function.json-encode.php
     */
    public static function json(mixed $input, bool $pretty = false): string
    {
        $options = 0;

        $options |= JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

        if ($pretty) {
            $options |= JSON_PRETTY_PRINT;
        }

        return json_encode($input, JSON_THROW_ON_ERROR | $options);
    }

    public static function utf8(string $string): string
    {
        $string = trim($string);
        // return mb_convert_encoding($string, 'UTF-8');
        $encoding_list = 'UTF-8, ISO-8859-13, ISO-8859-1, ASCII, UTF-7';
        if (mb_detect_encoding($string, $encoding_list) === 'UTF-8') {
            return $string;
        }

        return mb_convert_encoding($string, 'UTF-8', mb_detect_encoding($string, $encoding_list));
    }

    /**
     * Turns \My\CoolNamespace\MyClass into myClass
     * works as well with /my/path
     *
     * @param  string|object  $value
     * @return string
     */
    public static function basename(string|object $value): string
    {
        $value = is_object($value) ? get_class($value) : $value;

        return basename(str_replace('\\', '/', $value));
    }

    /**
     * Parses the string into variables
     *
     * @link https://www.php.net/manual/en/function.parse-str.php
     */
    public static function parseStr(mixed $string): array
    {
        $data = [];
        $string = str_replace(["&amp;", "\n"], "&", trim($string));
        parse_str($string, $data);
        if (!is_array($data)) {
            $data = [];
        }

        return $data;
    }

    /**
     * Converts html to text
     *
     * @param  string  $str
     * @return string
     */
    public static function htmlToText(string $str): string
    {
        return trim(html_entity_decode(strip_tags($str), ENT_QUOTES, "UTF-8"));
    }

    /**
     * Simple string templating
     *
     * @example render('my name is {name}',['name' => 'gen']) // 'my name is gen'
     * @param  array  $vars
     * @param  string|array  $syntax
     * @param  mixed  $template
     * @return string
     */
    public static function render(mixed $template, array $vars, string|array $syntax = '{}'): string
    {
        $map = [];
        foreach ($vars as $name => $value) {
            foreach ((array)$syntax as $singleSyntax) {
                [$start, $end] = mb_str_split($singleSyntax, 1);
                $map[$start.$name.$end] = $value;
            }
        }

        return strtr($template, $map);
    }

    /**
     * Encode HTML special characters in a string.
     *
     * @link https://www.php.net/manual/en/function.htmlspecialchars.php
     */
    public static function escapeHTML(mixed $value, bool $doubleEncode = true): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8', $doubleEncode);
    }

    //endregion

    /**
     * Get offset value
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @param  mixed  $default
     * @return mixed
     */
    public static function at(mixed $key, mixed $value, mixed $default = null): mixed
    {
        if (is_array($value)) {
            return array_key_exists($key, $value) ? $value[$key] : $default;
        }

        return isset($value[$key]) ? $key[$value] : $default;
    }


    /**
     * Set value to offset
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @param  mixed  $setValue
     * @return mixed
     */
    public static function setAt(mixed $key, mixed $value, mixed $setValue): mixed
    {
        if (is_string($value)) {
            $of = (array)mb_str_split($value, 1);
            $of[$key] = $setValue;

            return implode('', $of);
        }

        $value[$key] = $setValue;

        return $value;
    }

    /**
     * Remove offset value
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return mixed
     */
    public static function removeAt(mixed $key, mixed $value): mixed
    {
        if (is_string($value)) {
            $value = (array)mb_str_split($value, 1);
            unset($value[$key]);

            return implode('', $value);
        }
        unset($value[$key]);

        return $value;
    }
}
