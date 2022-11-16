<?php
namespace App\Service;

class SecondKataService
{
    /* @var string[] $sentences */
    public function analyze(array $sentences): string
    {
        $good = $bad = 0;

        foreach ($sentences as $sentence) {
            if (in_array($sentence[0], ['b', 'f', 'k'])) {
                $bad++;
            }

            if (in_array($sentence[0], ['g', 'n', 's'])) {
                $good++;
            }
        }

        return $good >= $bad ? 'good' : 'bad';
    }
}

