<?php

declare(strict_types=1);

namespace App;

class TrafficLightStateMachine
{
    /** @var string State. (Exercise 1) This variable name is used in tests. Do not rename.  */
    private $state;

    /**
     * Check if we are allowed to apply $state right now. Ie, is there an transition
     * from $this->state to $state?
     */
    public function can(string $transition): bool
    {
        switch($transition) {
            case 'to_yellow':
                return $this->state === 'green' || $this->state === 'red';
            case 'to_pre_red':
                return $this->state === 'green';
            case 'to_red':
                return $this->state === 'pre_red';
            case 'to_green':
                return $this->state === 'yellow';
        }
        return false;
    }

    /**
     * This will update $this->state.
     *
     * @throws \InvalidArgumentException if the $newState is invalid.
     */
    public function apply(string $transition): void
    {
        if (!$this->can($transition)) {
            throw new \InvalidArgumentException('Invalid newstate: '. $transition . ' current state: '. $this->state);
        }
        $this->state = substr($transition, 3);
    }
}
