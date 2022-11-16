<?php
namespace App\Service;

class ThirdKataService
{
    public function getSeat(string $data): string
    {
        $data = str_split($data);
        $letter = array_pop($data);
        $number = implode($data);

        if ($number > 60 || !in_array($letter, ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'K'])) {
            return 'No Seat!!';
        }

        return $this->getFirstPosition($number) . '-' . $this->getSecondPosition($letter);
    }

    private function getFirstPosition(int $number): string
    {
        if ($number < 21) {
            return 'Front';
        }

        if ($number < 41) {
            return 'Middle';
        }

        return 'Back';
    }

    private function getSecondPosition(string $letter): string
    {
        if (in_array($letter, ['A', 'B', 'C'])) {
            return 'Left';
        }

        if (in_array($letter, ['D', 'E', 'F'])) {
            return 'Middle';
        }

        return 'Right';
    }
}

