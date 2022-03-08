<?php

declare(strict_types=1);

$ℕ = function (): Generator {
    $n = 1;

    while (true) {
        yield $n++;
    }
};
$divisible = fn (int $a) => fn (int $b): bool => 0 === ($b % $a);
$addSuffix = fn (string $suffix) => fn (int $i): string => $suffix;
$justReturnTheNumber = fn (int $i): string => sprintf('%s', $i);

$lazy_iterable_map = fn (callable $callable) => function(iterable $iterable) use ($callable): Generator {
    foreach ($iterable as $key => $value) {
        yield $callable($value, $key);
    }
};

$rules = [
    [
        'if' => $divisible(15),
        'then' => $addSuffix('FizzBuzz'),
    ],
    [
        'if' => $divisible(3),
        'then' => $addSuffix('Fizz'),
    ],
    [
        'if' => $divisible(5),
        'then' => $addSuffix('Buzz'),
    ],
];

$input = new LimitIterator($ℕ(), 0, 100);

$fizzBuzz = fn (array $rules) => $lazy_iterable_map(
    fn (int $i): string =>
        match (true) {
            $rules[0]['if']($i) => $rules[0]['then']($i),
            $rules[1]['if']($i) => $rules[1]['then']($i),
            $rules[2]['if']($i) => $rules[2]['then']($i),
            default => $justReturnTheNumber($i),
        }
);

print implode(PHP_EOL, iterator_to_array($fizzBuzz($rules)($input)));