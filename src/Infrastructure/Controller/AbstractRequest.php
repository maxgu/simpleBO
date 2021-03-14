<?php

namespace Infrastructure\Controller;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractRequest
{
    protected RequestStack $requestStack;
    protected ValidatorInterface $validator;
    protected ?ConstraintViolationListInterface $errors = null;

    public function __construct(RequestStack $requestStack, ValidatorInterface $validator)
    {
        $this->requestStack = $requestStack;
        $this->validator = $validator;
    }

    public function isValid(array $fields): bool
    {
        if (empty($this->getConstraints())) {
            return true;
        }

        $this->errors = $this->validator->validate(
            $fields,
            new Assert\Collection($this->getConstraints())
        );

        if ($this->errors->count()) {
            return false;
        }

        return true;
    }

    public function getRawContent(): string
    {
        return (string)$this->requestStack->getCurrentRequest()->getContent();
    }

    public function getPayload(): array
    {
        if ($this->requestStack->getCurrentRequest()->request->count()) {
            return $this->requestStack->getCurrentRequest()->request->all();
        }

        $content = $this->requestStack->getCurrentRequest()->getContent();

        if (empty($content)) {
            throw new \InvalidArgumentException('Empty POST request.');
        }

        $content = \json_decode(
            $content,
            true,
            512,
            JSON_BIGINT_AS_STRING | (\PHP_VERSION_ID >= 70300 ? JSON_THROW_ON_ERROR : 0)
        );

        if (\PHP_VERSION_ID < 70300 && JSON_ERROR_NONE !== json_last_error()) {
            throw new \InvalidArgumentException(json_last_error_msg());
        }

        if (!\is_array($content)) {
            throw new \InvalidArgumentException(sprintf(
                'JSON content was expected to decode to an array, "%s"',
                get_debug_type($content)
            ));
        }

        return $content;
    }

    public function getQueryParams(): array
    {
        return $this->requestStack->getCurrentRequest()->query->all();
    }

    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }

    public function isPost(): bool
    {
        return $this->requestStack->getCurrentRequest()->isMethod('POST');
    }

    abstract protected function getConstraints(): array;
}
