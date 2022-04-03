<?php

declare(strict_types=1);

use AcmeWidget\Basket;

spl_autoload_register(static function (string $class): void {
    include __DIR__.'/src/'.str_replace('AcmeWidget\\', '', $class).'.php';
});

test(['B01', 'G01'], 37.85);
test(['R01', 'R01'], 54.37);
test(['R01', 'G01'], 60.85);
test(['B01', 'B01', 'R01', 'R01', 'R01'], 98.27);

function test(array $givenProducts, float $expectedTotalPrice): void
{
    $basket = Basket::create($givenProducts);
    $totalPrice = $basket->total();

    if (round($totalPrice, 5) === round($expectedTotalPrice, 5)) {
        echo 'Cart ['.implode(', ', $givenProducts).'], price: '.number_format($totalPrice, 5).' USD.'.PHP_EOL;
        return;
    }

    throw new Exception(implode(PHP_EOL, [
        'Test failed.',
        'Given products: '.implode(', ', $givenProducts).'.',
        'Expected final price: '.number_format($expectedTotalPrice, 5).' USD.',
        'Current final price: '.number_format($totalPrice, 5).' USD.',
    ]));
}
