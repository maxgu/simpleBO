<?php

namespace Infrastructure\Controller\GetMyself;

use Infrastructure\Controller\AbstractAction;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetMyselfAction extends AbstractAction
{
    #[Route('/api/get-myself', name: 'get-myself', methods: ["GET","HEAD"])]
    public function handle(): JsonResponse
    {
        return $this->respondSuccess([
            'userName' => 'admin',
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'role' => 'Admin',
        ]);
    }
}
