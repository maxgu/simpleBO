<?php

namespace Infrastructure\Controller\Backoffice\Film;

use Application\Command\Film\UpdateCommand;
use Application\Command\Film\UpdateHandler;
use Infrastructure\Controller\AbstractAction;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UpdateAction extends AbstractAction
{
    private UpdateHandler $handler;

    public function __construct(UpdateHandler $handler)
    {
        $this->handler = $handler;
    }

    #[Route('/api/backoffice/film/{id}/update', name: 'bo-film-update', methods: ["POST","HEAD"])]
    //#[IsGranted('get-myself')]
    public function handle(int $id, CreateActionRequest $request): JsonResponse
    {
        if (!$request->isValid($request->getPayload())) {
            return $this->respondFailValidation($request->getErrors());
        }

        $command = new UpdateCommand(
            $id,
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
