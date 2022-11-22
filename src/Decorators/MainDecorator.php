<?php
namespace App\Decorators;

use App\Components\StringComponentInterface;

class MainDecorator implements StringComponentInterface
{
    public function __construct(protected StringComponentInterface $component)
    { }

    public function doAction(): string
    {
        return $this->component->doAction();
    }
}
