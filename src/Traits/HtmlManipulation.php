<?php

namespace Infira\FluentValue\Traits;

use Infira\FluentValue\Flu;
use Infira\FluentValue\FluentValue;
use Wolo\Regex;

/**
 * @mixin FluentValue
 */
trait HtmlManipulation
{
    /**
     * Wrap current value with html tag
     * @uses static::htmlTag()
     * @example flu('Hello world!')->toHTMLTag('h1') //<h1>Hello world</h1>
     */
    public function toHTMLTag(string $tag): string
    {
        return Flu::surround($this->value, "<$tag>", "</$tag>");
    }


    /**
     * Parses the string into variables
     * @link https://www.php.net/manual/en/function.parse-str.php
     * @uses static::htmlAttributes()
     * @return string
     */
    public function toHTMLAttributes(): string
    {
        $result = [];
        foreach ($this->toParseStr() as $key => $value) {
            $result[] = $key.'="'.$value.'"';
        }

        return implode(' ', $result);
    }

    /**
     * Parses the string into variables
     * @link https://www.php.net/manual/en/function.parse-str.php
     * @uses static::htmlToText()
     */
    public function toTextFromHTML(): string
    {
        return Flu::htmlToText($this->value ?: '');
    }

    /**
     * @link https://php.net/manual/en/function.htmlspecialchars.php
     * @uses static::escapeHTML()
     */
    public function toEncodedHTML(bool $doubleEncode = true): string
    {
        return Flu::escapeHTML($this->value, $doubleEncode);
    }
}