<?php

namespace App\Strategy;

class OrderPhone implements StrategyInterface
{
    public function orderItems(array $items): array
    {
        usort($items, fn($a, $b) => strcmp($a->phone, $b->phone));

        return $items;
    }
}
