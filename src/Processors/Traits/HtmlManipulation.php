<?php

namespace Infira\FluentValue\Processors\Traits;

use Infira\FluentValue\Flu;
use Infira\FluentValue\Processors\FluentValueProcessor;

/**
 * @mixin FluentValueProcessor
 */
trait HtmlManipulation
{
    /**
     * Wrap current value with html tag
     *
     * @aliasof FluentImmutableValue::toHTMLTag()
     * @example flu('Hello world!')->htmlTag('h1') //<h1>Hello world</h1>
     * @param  string  $tag
     * @return string
     */
    public function htmlTag(string $tag): string
    {
        return Flu::surround($this->value, "<$tag>", "</$tag>");
    }


    /**
     * Parses the string into variables
     *
     * @aliasof FluentImmutableValue::toHTMLAttributes()
     * @return string
     * @uses FluentImmutableValue::$htmlAttributes
     */
    public function htmlAttributes(): string
    {
        $result = [];
        foreach ($this->parseStr() as $key => $value) {
            $result[] = $key.'="'.$value.'"';
        }

        return implode(' ', $result);
    }

    /**
     * Parses the string into variables
     *
     * @aliasof FluentImmutableValue::toTextFromHTML()
     * @return string
     * @uses FluentImmutableValue::$textFromHTML
     */
    public function htmlToText(): string
    {
        return Flu::htmlToText($this->value ?: '');
    }

    /**
     * @param  bool  $doubleEncode
     * @return string
     * @uses FluentImmutableValue::$escapedHTML
     */
    public function escapeHTML(bool $doubleEncode = true): string
    {
        return Flu::escapeHTML($this->value, $doubleEncode);
    }
}