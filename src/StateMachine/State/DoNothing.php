<?php

declare(strict_types=1);

namespace App\StateMachine\State;

use App\Service\MailerService;
use App\StateMachine\StateMachineInterface;

final class DoNothing implements StateInterface
{

    /**
     * @inheritDoc
     */
    public function send(StateMachineInterface $stateMachine, MailerService $mailer): int
    {
        return self::STOP;
    }

}
