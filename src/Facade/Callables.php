<?php

namespace Infira\FluentValue\Facade;

use Closure;
use Wolo\Callables\CallableInterceptor;

class Callables
{
    public static function makeInjectable(callable $callable): Closure
    {
        return CallableInterceptor::from($callable)->get();
    }

    public static function makeInjectableIfCan(?callable $callable): ?Closure
    {
        if (!$callable) {
            return null;
        }

        return CallableInterceptor::from($callable)->get();
    }
}