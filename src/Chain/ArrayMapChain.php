<?php

namespace Infira\FluentValue\Chain;

use Infira\FluentValue\Contracts\UnderlyingValue;
use Infira\FluentValue\FluentValue;
use Infira\FluentValue\Processors\Traits\Types;

/**
 * @mixin FluentValue
 */
class ArrayMapChain extends FluentChain
{
    public function run(): FluentValue
    {
        return $this->flu->map(function ($item) {
            return $this->reduceCallables($this->flu->new($item))->value();
        });
    }
}