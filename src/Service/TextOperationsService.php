<?php
namespace App\Service;

class TextOperationsService
{
    public string $text = '';
    public float $processingStartTime = 0;

    public function setText(string $text): void
    {
        $this->text = $text;
        $this->processingStartTime = microtime(true);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCharactersCount(): int
    {
        return mb_strlen($this->getText());
    }

    public function getWordsCount(): int
    {
        return count(preg_split('/\s+/', $this->getText()));
    }

    public function getSentencesCount(): int
    {
        return preg_match_all('/[^\s]([.!?])(?!\w)/', $this->getText());
    }

    public function getCharactersFrequency(): string
    {
        $result = '';

        $text = str_replace(' ', '', $this->getText());
        $arrLetters = str_split($text);
        $countLetters = count($arrLetters);
        $letters = [];

        foreach ($arrLetters as $letter) {
            if (isset($letters[$letter])) {
                $letters[$letter] += 1;
            } else {
                $letters[$letter] = 1;
            }
        }

        foreach ($letters as $letter => $total) {
            $result .= $letter.":".$total.":".round(($total/$countLetters*100), 2)."% \n";
        }

        return $result;
    }

    public function avgWordLength(): int
    {
        $wordLength = 0;
        $wordCount = 0;
        $totalWords = preg_split('/\s+/', $this->getText(), -1, PREG_SPLIT_NO_EMPTY);

        foreach ($totalWords as $word) {
            $wordCount++;
            $wordLength += strlen($word);
        }

        return $wordLength / $wordCount;
    }

    public function longestWords(): string
    {
        $arr = explode(" ", $this->getText());

        usort($arr, function ($a, $b) {
            return strlen($b) - strlen($a);
        });

        return implode(', ', array_slice($arr, 0, 3));
    }

    public function shortestWords(): string
    {
        $arr = explode(" ", $this->getText());

        usort($arr, function ($a, $b) {
            return strlen($a) - strlen($b);
        });

        return implode(', ', array_slice($arr, 0, 3));
    }

    public function longestSentences(): string
    {
        $arr = explode('.', $this->getText());

        usort($arr, function ($a, $b) {
            return strlen($b) - strlen($a);
        });

        return implode(', ', array_slice($arr, 0, 3));
    }

    public function shortestSentences(): string
    {
        $arr = explode('.', $this->getText());

        usort($arr, function ($a, $b) {
            return strlen($a) - strlen($b);
        });

        return implode(', ', array_slice($arr, 0, 3));
    }

    public function reverseText(): string
    {
        return strrev($this->getText());
    }

    public function reverseWords(): string
    {
        $array = explode(" ", $this->getText());

        return implode(" ", array_reverse($array));
    }

    public function processingTime(): float
    {
        return microtime(true) - $this->processingStartTime;
    }
}
