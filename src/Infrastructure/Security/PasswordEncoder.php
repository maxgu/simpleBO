<?php

namespace Infrastructure\Security;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEncoder implements \Application\Service\PasswordEncoder
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function encodePassword(string $plainPassword): string
    {
        return 'xxx';
    }
}
