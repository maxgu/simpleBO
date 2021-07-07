<?php

namespace Infrastructure\Controller\Backoffice\Film;

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

    #[Route('/api/backoffice/film/list', name: 'bo-film-list', methods: ["GET","HEAD"])]
    //#[IsGranted('get-myself')]
    public function handle(): JsonResponse
    {
        $result = $this->queryRepository->findBy(
            Criteria::fromQueryParameters('films', []),
            ['id', 'name', 'description', 'cover']
        );

        return $this->respondSuccess([
            'rows' => $result->take(0, 999),
        ]);
    }
}
