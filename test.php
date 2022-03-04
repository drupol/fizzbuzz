<?php

declare(strict_types=1);

function divisible(int $a, int $b): bool {
    return 0 === $a % $b;
}

for ($i = 1; $i <= 100; $i++) {
    if (divisible($i,15)) {
        echo "FizzBuzz\n";
    }
    else if (divisible($i, 3)) {
        echo "Fizz\n";
    }
    else if (divisible($i, 5)) {
        echo "Buzz\n";
    }
    else {
        echo "$i\n";
    }
}
