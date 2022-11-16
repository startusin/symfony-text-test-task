<?php
namespace App\Service;

use App\Model\Node;

class FirstKataService
{
    private function findNodes(Node $node, $index = 0): int
    {
        if (isset($node->index)) {
            return $index - $node->index;
        }

        $node->index = $index++;

        return $this->findNodes($node->getNext(), $index);
    }

    public function size(Node $node): int
    {
        return $this->findNodes($node);
    }
}
