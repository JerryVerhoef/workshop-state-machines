<?php

declare(strict_types=1);

namespace App\StateMachine;

use App\Entity\User;
use App\Service\MailerService;
use App\StateMachine\State\StateInterface;

class StateMachine implements StateMachineInterface
{
    private $user;
    /** @var StateInterface */
    private $state;
    private $mailer;

    public function __construct(MailerService $mailer, User $user)
    {
        $this->user = $user;
        $this->mailer = $mailer;
    }

    public function start(StateInterface $state): bool
    {
        $this->setState($state);
        $this->log();
        while($this->state->send($this, $this->mailer) === StateInterface::CONTINUE) {
            $this->log();
        }
        return true;
    }

    private function log(): void
    {
        echo "For User: ", $this->user->getId(), " Moved to " , get_class($this->state) , PHP_EOL;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setState(StateInterface $state): void
    {
        $this->state = $state;
    }
}
