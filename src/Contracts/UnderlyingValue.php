<?php

namespace Infira\FluentValue\Contracts;

interface UnderlyingValue
{
    /**
     * Get the underlying value
     *
     * @return mixed
     */
    public function value();
}