<?php

namespace Infrastructure\Controller;

use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class AbstractAction
{
    public function respondError(
        string $message,
        int $status = JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        array $payload = null
    ): JsonResponse {
        return new JsonResponse(
            [
                'status' => 'error',
                'message' => $message,
                'data' => $payload,
            ],
            $status
        );
    }

    public function respondFailValidation(ConstraintViolationListInterface $errors): JsonResponse
    {
        $messages = [];
        foreach ($errors as $error) {
            $key = substr($error->getPropertyPath(), 1, -1);
            $messages[$key] = $error->getMessage();
        }

        return $this->respondFail('Validation errors', JsonResponse::HTTP_BAD_REQUEST, $messages);
    }

    public function respondFail(
        string $message,
        int $status = JsonResponse::HTTP_BAD_REQUEST,
        array $payload = null
    ): JsonResponse {
        return new JsonResponse(
            [
                'status' => 'fail',
                'message' => $message,
                'data' => $payload,
            ],
            $status
        );
    }

    /**
     * @param mixed $payload
     * @param string|null $message
     * @return JsonResponse
     */
    public function respondSuccess($payload = null, string $message = null): JsonResponse
    {
        return new JsonResponse(
            [
                'status' => 'success',
                'data' => $payload,
            ],
            JsonResponse::HTTP_OK
        );
    }
}
