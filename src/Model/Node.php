<?php

namespace App\Model;

class Node
{
    public function __construct(private object $node) {}

    public function getNext(): ?self {
        $node = $this->getNode() ?? null;

        if (!$node) {
            return null;
        }

        $this->setNode($node);

        return $node;
    }

    private function getNode(): self {
        if (!($this->node instanceof self)) {
            $this->setNode(new self($this->node));
        }

        return $this->node;
    }

    private function setNode(self $node): void {
        $this->node = $node;
    }
}
