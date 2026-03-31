<?php

namespace Infira\FluentValue\Processors\Traits;

use Traversable;
use Wolo\Is;

trait Finals
{
    use Comparing;
    use Types;

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->toArray());
    }
}