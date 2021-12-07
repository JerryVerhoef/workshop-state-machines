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
    public function can(StateInterface $light, string $transition): bool
    {
        switch ($light->getState()) {
            case 'green':
                return ($transition === 'to_yellow');
            case 'yellow':
                return ($transition === 'to_green' || $transition === 'to_red');
            case 'red':
                return ($transition === 'to_yellow');
            default:
                return false;
        }
    }

    /**
     * This will update $this->state.
     *
     * @throws \InvalidArgumentException if the $newState is invalid.
     */
    public function apply(StateInterface $light, string $transition): void
    {
        if (!$this->can($light, $transition)) {
            throw new \InvalidArgumentException('Invalid transition');
        }

        switch ($light->getState()) {
            case 'green' && ($transition === 'to_yellow'):
                $newState = 'yellow';
                break;
            case 'yellow' && ($transition === 'to_green'):
                $newState = 'green';
                break;
            case 'yellow' && ($transition === 'to_red'):
                $newState = 'red';
                break;
            case 'red' && ($transition === 'to_yellow'):
                $newState = 'yellow';
                break;
            default:
                $newState = $light->getState();
        }
        $light->setState($newState);
    }
}
