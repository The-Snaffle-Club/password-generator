<?php declare(strict_types=1);

namespace Destination\PasswordGenerator;

class PasswordGenerator
{
    /** @var string Default password structure returns something like CorrectHorse%BatteryStaple7 */
    public const DEFAULT_STRUCTURE = 'WWSWWD';
    /** @var string $ and * are excluded to avoid accidental expansion and variable substitution in Linux shells */
    public const DEFAULT_SYMBOLS = '~!@#%^&(){}[],./?';

    public const STRUCTURE_WORD = 'W';
    public const STRUCTURE_SYMBOL = 'S';
    public const STRUCTURE_DIGIT = 'D';

    private const MIN_WORD_LENGTH = 4;
    private const MAX_WORD_LENGTH = 8;

    private WordList $wordList;

    public function __construct(string $wordListPath = __DIR__ . '/../var/wordlist')
    {
        $this->wordList = new WordList($wordListPath);
    }

    public function generate(string $structure = self::DEFAULT_STRUCTURE, string $symbols = self::DEFAULT_SYMBOLS): string
    {
        $password = '';
        foreach (str_split($structure) as $chunk) {
            switch ($chunk) {
                case self::STRUCTURE_WORD:
                    $password .= ucfirst(strtolower($this->wordList->getRandomWord(self::MIN_WORD_LENGTH, self::MAX_WORD_LENGTH)));
                    break;
                case self::STRUCTURE_DIGIT:
                    $password .= random_int(0, 9);
                    break;
                case self::STRUCTURE_SYMBOL:
                    $password .= $symbols[random_int(0, \strlen($symbols) - 1)];
                    break;
            }
        }

        return $password;
    }
}
