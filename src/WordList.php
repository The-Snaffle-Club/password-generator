<?php declare(strict_types=1);

namespace Destination\PasswordGenerator;

class WordList
{
    private string $wordListPath;

    public function __construct(string $wordListPath)
    {
        $this->wordListPath = $wordListPath;
    }

    public function getRandomWord(int $minLength = 0, int $maxLength = \PHP_INT_MAX): string
    {
        $wordList  = $this->getWords();
        $wordCount = $this->getWordCount();

        do {
            $word = trim($wordList[random_int(0, $wordCount - 1)]);
        } while (\strlen($word) < $minLength || \strlen($word) > $maxLength);

        return $word;
    }

    public function getWords(): array
    {
        static $words;
        if ($words === null) {
            $words = file($this->wordListPath);
        }

        return $words;
    }

    public function getWordCount(): int
    {
        static $wordCount;
        if ($wordCount === null) {
            $wordCount = \count($this->getWords());
        }

        return $wordCount;
    }
}
