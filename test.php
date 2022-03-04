<?php

declare(strict_types=1);

function divisible(int $a): Closure {
    return function (int $b) use ($a): bool {
        return 0 === $a % $b;
    };
}

$input = range(1, 100);

$output = array_map(
    function (int $i): string {
        $divisible = divisible($i);

        if ($divisible(15)) {
            return 'FizzBuzz';
        }

        if ($divisible(3)) {
            return 'Fizz';
        }

        if ($divisible(5)) {
            return 'Buzz';
        }

        return (string) $i;
    },
    $input
);

print implode(PHP_EOL, $output);