<?php

namespace App\Strategy;

class Context
{
    public function __construct(
        private StrategyInterface $strategy,
        private array $data = [],
    )
    { }

    public function setStrategy(StrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function doOrdering(): array
    {
        return $this->strategy->orderItems($this->data);
    }
}
