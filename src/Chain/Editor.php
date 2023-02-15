<?php

namespace Infira\FluentValue\Chain;

use Infira\FluentValue\Contracts\Processor;
use Infira\FluentValue\FluentValue;
use Infira\FluentValue\Traits\FluentImmutableValue;
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
        $this->flu->edit($val);

        if (!$this->endMutationManually) {
            return $this->endMutation();
        }

        return $this;
    }

    public function __get(string $name)
    {
        if (method_exists(FluentImmutableValue::class, $name)) {
            return $this->__call($name, []);
        }
        throw new \InvalidArgumentException("property|method('$name') does not exist");
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