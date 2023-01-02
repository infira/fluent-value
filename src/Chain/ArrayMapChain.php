<?php

namespace Infira\FluentValue\Chain;

use Infira\FluentValue\FluentValue;

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