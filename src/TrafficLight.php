<?php

declare(strict_types=1);

namespace App;

final class TrafficLight implements StateInterface
{
    private string $state;

    public function __construct(string $state)
    {
        $this->state = $state;
    }

    /* @return string */
    public function getState(): string
    {
        return $this->state;
    }

    /* @param string $state */
    public function setState(string $state): void
    {
        $this->state = $state;
    }
}
