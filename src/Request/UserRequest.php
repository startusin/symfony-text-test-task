<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;

class UserRequest extends BaseRequest
{
    #[NotBlank()]
    protected string $name;

    #[NotBlank()]
    protected string $surname;

    #[NotBlank()]
    protected string $phone;
}
