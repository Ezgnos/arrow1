<?php
declare(strict_types=1);

// Задача 3. Обработка массива товаров (без foreach/for)

$products = [
    ['title' => 'Книга',    'price' => 500],
    ['title' => 'Рюкзак',   'price' => 2500],
    ['title' => 'Кружка',   'price' => 350],
    ['title' => 'Наушники', 'price' => 4200],
    ['title' => 'Блокнот',  'price' => 150],
];

// 1) array_map: строки «Книга — 500 руб.»
$lines = array_map(fn(array $p): string => "{$p['title']} — {$p['price']} руб.", $products);
echo implode(PHP_EOL, $lines) . PHP_EOL . PHP_EOL;

// 2) array_filter: товары дороже 1000 руб.
$expensive = array_filter($products, fn(array $p): bool => $p['price'] > 1000);
echo 'Дороже 1000 руб.: ' . implode(', ', array_map(fn(array $p): string => $p['title'], $expensive)) . PHP_EOL;

// 3) array_reduce: общая стоимость
$total = array_reduce($products, fn(int $sum, array $p): int => $sum + $p['price'], 0);
echo "Общая стоимость: {$total} руб." . PHP_EOL . PHP_EOL;

// 4) array_map: скидка 15% — новый массив, исходный не меняется
$discounted = array_map(
    fn(array $p): array => array_merge($p, ['price' => round($p['price'] * 0.85, 2)]),
    $products
);
echo 'Со скидкой 15%:' . PHP_EOL;
echo implode(PHP_EOL, array_map(fn(array $p): string => "{$p['title']} — {$p['price']} руб.", $discounted)) . PHP_EOL;
echo 'Исходная цена первой книги осталась: ' . $products[0]['price'] . ' руб.' . PHP_EOL;
