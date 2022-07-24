<?php

namespace App\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseRequest
{
    /**
     * @throws \Exception
     */
    public function __construct(protected ValidatorInterface $validator)
    {
        $this->populate();
        $this->validate();
    }

    public function __get(string $property): mixed
    {
        return $this->{$property};
    }

    /**
     * @throws \Exception
     */
    public function validate(): ConstraintViolationListInterface
    {
        $errors = $this->validator->validate($this);

        if ($errors->count() > 0) {
            throw new \Exception('Validation error.');
        }

        return $errors;
    }

    public function getRequest(): Request
    {
        return Request::createFromGlobals();
    }

    private function populate(): void
    {
        foreach ($this->getRequest()->request->all() as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
