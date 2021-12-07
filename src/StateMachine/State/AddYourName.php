<?php

declare(strict_types=1);

namespace App\StateMachine\State;

use App\Service\MailerService;
use App\StateMachine\StateMachineInterface;

class AddYourName implements StateInterface
{
    public function send(StateMachineInterface $stateMachine, MailerService $mailer): int
    {
        $user = $stateMachine->getUser();
        if ($user->isAllowedToBeSentEmail() === false) {
            echo "Not allowed to sent email for user: ", $user->getId(), PHP_EOL;
            return self::STOP;
        }

        if ($user->getName() === null && $user->getEmail() !== null) {
            $mailer->sendEmail($user, "Please set name");
            $user->setSentMail("2021-12-07");
            return self::STOP;
        }
        $stateMachine->setState(new AddYourTwitter());
        return self::CONTINUE;
    }

}
