<?php

declare(strict_types=1);

$divisible = fn (int $a) => fn (int $b): bool => 0 === $b % $a;

$input = range(1, 100);

$rules = [
    [
        'when' => $divisible(3),
        'then' => 'Fizz',
    ],
    [
        'when' => $divisible(5),
        'then' => 'Buzz',
    ]
];

$output = array_map(
    function (int $i) use ($rules): string {
        $reduced = array_reduce(
            $rules,
            fn (?string $acc, array $rule): string => $acc . (($rule['when'])($i) ? $rule['then'] : null)
        );

        return ('' === $reduced ? (string) $i : $reduced);
    },
    $input
);

print implode(PHP_EOL, $output);