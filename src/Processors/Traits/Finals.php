<?php

namespace Infira\FluentValue\Processors\Traits;

use Infira\FluentValue\Flu;
use Traversable;
use Wolo\Is;

trait Finals
{
    use Comparing;
    use Types;
    use Files;

    /**
     * @final
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->toArray());
    }
}