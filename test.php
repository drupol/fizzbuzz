<?php

declare(strict_types=1);

$input = range(1, 100);
$divisible = fn (int $a) => fn (int $b) => fn (string $acc): bool => 0 === ($b % $a);
$accIsEmpty = fn (int $i) => fn (string $acc): bool => $acc === '';
$addSuffix = fn (string $suffix) => fn (int $i) => fn (string $acc): string => sprintf('%s%s', $acc, $suffix);
$justReturnTheNumber = fn (int $i) => fn (string $acc): string => sprintf('%s', $i);

$rules = [
    [
        'if' => $divisible(3),
        'then' => $addSuffix('Fizz'),
        'else' => $addSuffix(''),
    ],
    [
        'if' => $divisible(5),
        'then' => $addSuffix('Buzz'),
        'else' => $addSuffix(''),
    ],
    [
        'if' => $accIsEmpty,
        'then' => $justReturnTheNumber,
        'else' => $addSuffix(''),
    ]
];

$output = array_map(
    fn (int $i): string =>
        array_reduce(
            $rules,
            fn (string $acc, array $rule): string => (($rule['if'])($i)($acc) ? ($rule['then'])($i)($acc) : ($rule['else'])($i)($acc)),
            ''
        )
    ,
    $input
);

print implode(PHP_EOL, $output);