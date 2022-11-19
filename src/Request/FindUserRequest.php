<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;

class FindUserRequest extends BaseRequest
{
    #[NotBlank()]
    protected string $name;
}
