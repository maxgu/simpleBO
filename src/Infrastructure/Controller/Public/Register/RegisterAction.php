<?php

namespace Infrastructure\Controller\Public\Register;

use Application\Command\User\CreateCommand;
use Application\Command\User\CreateHandler;
use Infrastructure\Controller\AbstractAction;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RegisterAction extends AbstractAction
{
    private CreateHandler $handler;

    public function __construct(CreateHandler $security)
    {
        $this->handler = $security;
    }

    #[Route('/api/public/register', name: 'register', methods: ["POST","HEAD"])]
    public function handle(RegisterActionRequest $request): JsonResponse
    {
        if (!$request->isValid($request->getPayload())) {
            return $this->respondFailValidation($request->getErrors());
        }

        $command = new CreateCommand(
            $request->getEmail(),
            $request->getName(),
            $request->getPassword()
        );

        if (!$this->handler->handle($command)) {
            return $this->respondFail($this->handler->getError());
        }

        return $this->respondSuccess();
    }
}
