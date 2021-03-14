<?php

namespace Infrastructure\Listener;

use Infrastructure\Controller\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $response = new JsonResponse(
            [
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => null,
            ],
            JsonResponse::HTTP_INTERNAL_SERVER_ERROR
        );

        $event->setResponse($response);
    }
}