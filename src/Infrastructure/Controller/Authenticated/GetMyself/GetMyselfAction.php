<?php

namespace Infrastructure\Controller\Authenticated\GetMyself;

use Infrastructure\Controller\AbstractAction;
use Infrastructure\Security\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
    //#[IsGranted('get-myself')]
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
