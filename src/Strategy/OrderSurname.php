<?php

namespace App\Strategy;

class OrderSurname implements StrategyInterface
{
    public function orderItems(array $items): array
    {
        usort($items, fn($a, $b) => strcmp($a->surname, $b->surname));

        return $items;
    }
}
