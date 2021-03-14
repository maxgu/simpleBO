<?php

namespace Infrastructure\Controller\Auth;

use Infrastructure\Controller\AbstractRequest;
use Symfony\Component\Validator\Constraints as Assert;

class AuthRequest extends AbstractRequest
{
    protected function getConstraints(): array
    {
        return [
            'userName' => [
                new Assert\Required(),
                new Assert\Length(['min' => 1]),
            ],
            'password' => new Assert\Length(['min' => 1]),
        ];
    }

    public function getUserName(): string
    {
        return $this->getPayload()['userName'];
    }

    public function getPassword(): string
    {
        return $this->getPayload()['password'];
    }
}
