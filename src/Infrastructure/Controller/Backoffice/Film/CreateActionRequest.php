<?php

namespace Infrastructure\Controller\Backoffice\Film;

use Infrastructure\Controller\AbstractRequest;
use Symfony\Component\Validator\Constraints as Assert;

class CreateActionRequest extends AbstractRequest
{
    protected function getConstraints(): array
    {
        return [
            'name' => new Assert\Length(['min' => 1, 'max' => 100]),
            'description' => new Assert\Length(['min' => 1, 'max' => 500]),
            'cover' => new Assert\Length(['min' => 1, 'max' => 255]),
        ];
    }

    public function getName(): string
    {
        return $this->getPayload()['name'];
    }

    public function getDescription(): string
    {
        return $this->getPayload()['description'];
    }

    public function getCover(): string
    {
        return $this->getPayload()['cover'];
    }
}
