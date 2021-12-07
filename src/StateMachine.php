<?php

declare(strict_types=1);

namespace App;

final class StateMachine
{
    /** @var array<string, array<string>> */
    private array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function can(StateInterface $state, string $transition): bool
    {
        return isset($this->rules[$state->getState()][$transition]);
    }

    public function apply(StateInterface $state, string $transition): void
    {
        if (!$this->can($state, $transition)) {
            throw new \InvalidArgumentException('new state ' . $transition . ' for ' . $state->getState());
        }

        $state->setState($this->rules[$state->getState()][$transition]);
    }
}
