<?php

namespace Infrastructure\Controller\Register;

use Infrastructure\Controller\AbstractRequest;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterActionRequest extends AbstractRequest
{
    protected function getConstraints(): array
    {
        return [
            'name' => new Assert\Length(['min' => 1, 'max' => 60]),
            'email' => new Assert\Email(),
            'password' => new Assert\Length(['min' => 1]),
        ];
    }

    public function getName(): string
    {
        return $this->getPayload()['name'];
    }

    public function getEmail(): string
    {
        return $this->getPayload()['email'];
    }

    public function getPassword(): string
    {
        return $this->getPayload()['password'];
    }
}
