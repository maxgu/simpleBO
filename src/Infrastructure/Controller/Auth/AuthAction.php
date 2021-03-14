<?php

namespace Infrastructure\Controller\Auth;

use Infrastructure\Controller\AbstractAction;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthAction extends AbstractAction
{
    #[Route('/api/auth', name: 'auth', methods: ["POST","HEAD"])]
    public function handle(AuthRequest $request): JsonResponse
    {
        if  (!$request->isValid($request->getPayload())) {
            return $this->respondFailValidation($request->getErrors());
        }

        if ($request->getUserName() !== 'admin') {
            return $this->respondFail('Bad username');
        }

        if ($request->getPassword() !== '123456') {
            return $this->respondFail('Password incorrect');
        }

        return $this->respondSuccess();
    }
}
