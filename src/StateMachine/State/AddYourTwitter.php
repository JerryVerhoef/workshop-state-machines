<?php

declare(strict_types=1);

namespace App\StateMachine\State;

use App\Service\MailerService;
use App\StateMachine\StateMachineInterface;

final class AddYourTwitter implements StateInterface
{

    public function send(StateMachineInterface $stateMachine, MailerService $mailer): int
    {
        $user = $stateMachine->getUser();
        if ($user->isAllowedToBeSentEmail() === false) {
            echo "Not allowed to sent email";
            return self::STOP;
        }

        if ($user->getTwitter() === null && $user->getEmail() !== null) {
            $mailer->sendEmail($user, "Please set Twitter");
            // Do Not setSentDate I want this user to always run :)
            //
            return self::STOP;
        }
        $stateMachine->setState(new WelcomeToPurgatory());
        return self::CONTINUE;
    }
}
