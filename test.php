<?php

declare(strict_types=1);

function divisible(int $a): Closure {
    return function (int $b) use ($a): bool {
        return 0 === $a % $b;
    };
}

$input = range(1, 100);
$rules = [
    [
        'when' => 3,
        'then' => 'Fizz',
    ],
    [
        'when' => 5,
        'then' => 'Buzz',
    ]
];

$output = array_map(
    function (int $i) use ($rules): string {
        $divisible = divisible($i);

        $reduced = array_reduce(
            $rules,
            function (string $acc, array $rule) use ($divisible): string {
                return $acc . ($divisible($rule['when']) ? $rule['then'] : '');
            },
            ''
        );

        return ('' === $reduced ? (string) $i : $reduced);
    },
    $input
);

print implode(PHP_EOL, $output);