<?php

namespace App\Strategy;

interface StrategyInterface
{
    public function orderItems(array $items): array;
}
