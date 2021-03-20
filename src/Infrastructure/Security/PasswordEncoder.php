<?php

namespace Infrastructure\Security;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class PasswordEncoder implements \Application\Service\PasswordEncoder
{
    private EncoderFactoryInterface $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function encodePassword(string $plainPassword): string
    {
        $encoder = $this->encoderFactory->getEncoder(new User('email@mail.com', 'User'));

        return $encoder->encodePassword($plainPassword, null);
    }
}
