<?php

namespace Infrastructure\Controller\Backoffice\User;

use Infrastructure\Controller\AbstractAction;
use Infrastructure\Service\Query\Criteria;
use Infrastructure\Service\Query\QueryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListAction extends AbstractAction
{
    private QueryRepository $queryRepository;

    public function __construct(QueryRepository $queryRepository)
    {
        $this->queryRepository = $queryRepository;
    }

    #[Route('/api/backoffice/user/list', name: 'bo-user-list', methods: ["GET","HEAD"])]
    //#[IsGranted('get-myself')]
    public function handle(): JsonResponse
    {
        $result = $this->queryRepository->findBy(
            Criteria::fromQueryParameters('users', []),
            ['id', 'name', '"Admin" AS role', 'email']
        );

        return $this->respondSuccess([
            'rows' => $result->take(0, 999),
        ]);
    }
}
