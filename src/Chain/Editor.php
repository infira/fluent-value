<?php

namespace Infira\FluentValue\Chain;

use Infira\FluentValue\Contracts\Processor;
use Infira\FluentValue\FluentValue;
use Wolo\Contracts\UnderlyingValue;

/**
 * @mixin FluentValue
 */
class Editor implements UnderlyingValue
{
    public function __construct(private FluentValue $flu, private bool $endMutationManually = false) {}


    public function __call(string $name, array $arguments)
    {
        [, $val] = $this->flu->callProcessors($name, $arguments);
        if ($val instanceof Processor) {
            $val = $val->value();
        }
        $this->flu->setValue($val);

        if (!$this->endMutationManually) {
            return $this->endMutation();
        }

        return $this;
    }

    public function endMutation(): FluentValue
    {
        $this->endMutationManually = false;

        return $this->flu;
    }

    public function value(): mixed
    {
        return $this->endMutation()->value();
    }
}