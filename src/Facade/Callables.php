<?php

namespace Infira\FluentValue\Facade;

use Wolo\Callables\CallableInterceptor;

class Callables
{
    public static function makeInjectable(callable $callable): \Closure {
        return CallableInterceptor::from($callable)->get(true);
    }
}