<?php

namespace Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse as SymfonyJsonResponse;

class JsonResponse extends SymfonyJsonResponse
{
    protected array $responseData;

    public function getStatus(): string
    {
        return $this->responseData['status'];
    }

    public function getData(): array
    {
        return $this->responseData['data'];
    }

    public function getFullData(): array
    {
        return $this->responseData;
    }

    public function getMessage(): string
    {
        return $this->responseData['message'];
    }

    /**
     * @param mixed $data
     * @return $this
     */
    public function setData($data = [])
    {
        parent::setData($data);

        $this->responseData = \json_decode((string)$this->data, true);
        return $this;
    }
}
