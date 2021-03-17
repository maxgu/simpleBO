<?php

namespace Application\Service;

interface PasswordEncoder
{
    public function encodePassword(string $plainPassword): string;
}
