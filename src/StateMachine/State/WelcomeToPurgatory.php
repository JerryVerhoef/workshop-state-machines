<?php

declare(strict_types=1);

namespace App\StateMachine\State;

use App\Service\MailerService;
use App\StateMachine\StateMachineInterface;

final class WelcomeToPurgatory implements StateInterface
{
    public function send(StateMachineInterface $stateMachine, MailerService $mailer): int
    {
        $user = $stateMachine->getUser();
        if ($user->isAllowedToBeSentEmail() === false) {
            echo "Not allowed to sent email";
            return self::STOP;
        }

        if ($user->isComplete()) {
            $mailer->sendEmail($user, "Welcome to purgatory");
            $user->setSentMail("2021-12-07");
        }
        return self::STOP;
    }
}
