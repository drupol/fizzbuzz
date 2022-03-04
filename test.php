<?php

declare(strict_types=1);

function divisible(int $a): Closure {
    return function (int $b) use ($a): bool {
        return 0 === $a % $b;
    };
}

for ($i = 1; $i <= 100; $i++) {
    $divisible = divisible($i);

    if ($divisible(15)) {
        echo "FizzBuzz\n";
    }
    else if ($divisible(3)) {
        echo "Fizz\n";
    }
    else if ($divisible(5)) {
        echo "Buzz\n";
    }
    else {
        echo "$i\n";
    }
}
