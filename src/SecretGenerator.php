<?php declare(strict_types=1);

namespace Destination\PasswordGenerator;

class SecretGenerator
{
    private const KEY_SPACES = [
        'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'abcdefghijklmnopqrstuvwxyz',
        '0123456789',
        '~!@#$%^&*(){}[],./?',
    ];

    public function generate(int $length = 64, bool $alnum = true): string
    {
        $keySpaces = self::KEY_SPACES;

        if ($alnum) {
            $keySpaces = \array_slice($keySpaces, 0, 3);
        }

        $keySpaceCount = \count($keySpaces);

        $secret = '';

        // First get one character from each key space.
        foreach ($keySpaces as $keySpace) {
            $secret .= $keySpace[random_int(0, \strlen($keySpace) - 1)];
        }

        // Then build the rest of the secret using random characters from random key spaces.
        while (\strlen($secret) < $length) {
            $keySpace = $keySpaces[random_int(0, $keySpaceCount - 1)];
            $secret .= $keySpace[random_int(0, \strlen($keySpace) - 1)];
        }

        // Shuffle the secret so the one character from each key space isn't always at the beginning.
        return self::fisherYatesShuffle($secret);
    }

    /**
     * @see https://en.wikipedia.org/wiki/Fisher%E2%80%93Yates_shuffle
     */
    private static function fisherYatesShuffle(string $input): string
    {
        for ($i = \strlen($input) - 1; $i > 0; --$i) {
            $j         = random_int(0, $i);
            $tmp       = $input[$i];
            $input[$i] = $input[$j];
            $input[$j] = $tmp;
        }

        return $input;
    }
}
