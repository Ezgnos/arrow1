<?php
declare(strict_types=1);

// Задача 1. Знакомство с синтаксисом fn

$square = fn(int $x): int => $x * $x;
$isEven = fn(int $x): bool => $x % 2 === 0;
$greet  = fn(string $name): string => "Привет, {$name}!";
$max    = fn(int $a, int $b): int => $a > $b ? $a : $b; // тернарный оператор — одно выражение

echo 'Квадрат 5: ' . $square(5) . PHP_EOL;
echo 'Квадрат 12: ' . $square(12) . PHP_EOL;

echo '4 чётное? ' . var_export($isEven(4), true) . PHP_EOL;
echo '7 чётное? ' . var_export($isEven(7), true) . PHP_EOL;

echo $greet('Анна') . PHP_EOL;
echo $greet('Борис') . PHP_EOL;

echo 'Максимум из 3 и 8: ' . $max(3, 8) . PHP_EOL;
echo 'Максимум из 10 и -2: ' . $max(10, -2) . PHP_EOL;

/*
 * Та же функция $max в классическом виде:
 *
 * $max = function (int $a, int $b): int {
 *     return $a > $b ? $a : $b;
 * };
 *
 * Сравнение: fn-версия занимает одну строку без слов function и return и без фигурных скобок,
 * классическая — три строки и больше служебных слов. Для короткого выражения fn читается легче.
 */
