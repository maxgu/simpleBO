<?php

namespace Infrastructure\Controller\Backoffice\Film;

use Application\Command\Film\CreateCommand;
use Application\Command\Film\CreateHandler;
use Infrastructure\Controller\AbstractAction;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CreateAction extends AbstractAction
{
    private CreateHandler $handler;

    public function __construct(CreateHandler $handler)
    {
        $this->handler = $handler;
    }

    #[Route('/api/backoffice/film/create', name: 'bo-film-create', methods: ["POST","HEAD"])]
    //#[IsGranted('get-myself')]
    public function handle(CreateActionRequest $request): JsonResponse
    {
        if (!$request->isValid($request->getPayload())) {
            return $this->respondFailValidation($request->getErrors());
        }

        $command = new CreateCommand(
            $request->getName(),
            $request->getDescription(),
            $request->getCover()
        );

        if (!$this->handler->handle($command)) {
            return $this->respondFail($this->handler->getError());
        }

        return $this->respondSuccess();
    }
}
