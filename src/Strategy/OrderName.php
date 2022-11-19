<?php

namespace App\Strategy;

class OrderName implements StrategyInterface
{
    public function orderItems(array $items): array
    {
        usort($items, fn($a, $b) => strcmp($a->name, $b->name));

        return $items;
    }
}
