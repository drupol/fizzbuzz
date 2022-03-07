<?php

declare(strict_types=1);

$ℕ = function (): Generator {
    $n = 1;

    while (true) {
        yield $n++;
    }
};
$divisible = fn (int $a) => fn (int $b) => fn (string $acc): bool => 0 === ($b % $a);
$accIsEmpty = fn (int $i) => fn (string $acc): bool => $acc === '';
$addSuffix = fn (string $suffix) => fn (int $i) => fn (string $acc): string => sprintf('%s%s', $acc, $suffix);
$justReturnTheNumber = fn (int $i) => fn (string $acc): string => sprintf('%s', $i);

$lazy_iterable_map = fn (callable $callable) => function(iterable $iterable) use ($callable): Generator {
    foreach ($iterable as $key => $value) {
        yield $callable($value, $key);
    }
};
$ifThenElse = fn (callable $predicate) => fn (callable $then) => fn (callable $else) => fn (int $a) => fn (string $b): string => $predicate($a)($b) ? $then($a)($b) : $else($a)($b);

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

$input = new LimitIterator($ℕ(), 0, 100);

$fizzBuzz = fn (array $rules) => $lazy_iterable_map(
    fn (int $i): string =>
        array_reduce(
            $rules,
            fn (string $acc, array $rule): string => $ifThenElse($rule['if'])($rule['then'])($rule['else'])($i)($acc),
            ''
        )
);

print implode(PHP_EOL, iterator_to_array($fizzBuzz($rules)($input)));