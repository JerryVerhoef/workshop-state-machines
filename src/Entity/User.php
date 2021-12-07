<?php

declare(strict_types=1);

namespace App\Entity;

use App\WorldClock;

class User
{
    private $id;
    private $name;
    private $email;
    private $twitter;
    private $sentMailDate;

    /**
     * Convert a user to array (used when we store user in database)
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'twitter' => $this->twitter,
            'sentMailDate' => $this->sentMailDate,
        ];
    }

    /**
     * Convert a array to a user
     */
    public static function fromArray(array $data): User
    {
        $user = new self();

        $user->id = (int) $data['id'];
        $user->name = $data['name'] ?? null;
        $user->email = $data['email'] ?? null;
        $user->twitter = $data['twitter'] ?? null;
        $user->sentMailDate = $data['sentMailDate'] ?? null;

        return $user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name)
    {
        $this->name = $name;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email)
    {
        $this->email = $email;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter)
    {
        $this->twitter = $twitter;
    }

    public function isComplete(): bool
    {
        return $this->twitter !== null && $this->email !== null && $this->name !== null;
    }

    public function isAllowedToBeSentEmail(): bool
    {
        if ($this->sentMailDate === null) {
            return true;
        }
        $diff = WorldClock::getDateTimeRelativeFakeTime()->diff(WorldClock::getDateTimeRelativeFakeTime($this->sentMailDate));

        return $diff->days > 0 && $diff->invert === 0;

    }

    public function setSentMail(string $dateString)
    {
        $this->sentMailDate = $dateString;
    }
}
