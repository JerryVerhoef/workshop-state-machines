<?php

declare(strict_types=1);

namespace App;

interface StateInterface
{
    /* @return string */
    public function getState(): string;

    /* @param string $state */
    public function setState(string $state): void;
}
