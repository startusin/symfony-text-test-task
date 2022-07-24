<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;

class TextOperationsRequest extends BaseRequest
{
    #[NotBlank()]
    protected string $text;
}
