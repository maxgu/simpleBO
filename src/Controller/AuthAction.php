<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthAction
{
    /**
     * @Route("/api/auth", name="auth", methods={"POST","HEAD"})
     */
    public function handle(): JsonResponse
    {
        return new JsonResponse(['success' => 'ok']);
    }
}
