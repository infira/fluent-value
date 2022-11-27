<?php


use Infira\FluentValue\FluentValue;

if (!function_exists('flu')) {
    function flu(mixed $value, array $attributes = []): FluentValue
    {
        return \Infira\FluentValue\Flu::of($value, $attributes);
    }
}
