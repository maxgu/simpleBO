<?php

namespace Infrastructure\Controller\GetMyself;

use Infrastructure\Controller\AbstractAction;
use Infrastructure\Security\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class GetMyselfAction extends AbstractAction
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/api/get-myself', name: 'get-myself', methods: ["GET","HEAD"])]
    public function handle(): JsonResponse
    {
        /** @var User $user */
        $user = $this->security->getUser();
        return $this->respondSuccess([
            'name' => $user->getName(),
            'email' => $user->getUsername(),
            'role' => 'Admin',
        ]);
    }
}
