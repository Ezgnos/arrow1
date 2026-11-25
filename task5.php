<?php
declare(strict_types=1);

// Задача 5. Мини-проект «Анализ заказов»

$orders = [
    ['id' => 1, 'customer' => 'Иван',  'total' => 1200, 'status' => 'done'],
    ['id' => 2, 'customer' => 'Мария', 'total' => 800,  'status' => 'new'],
    ['id' => 3, 'customer' => 'Пётр',  'total' => 3500, 'status' => 'done'],
    ['id' => 4, 'customer' => 'Анна',  'total' => 600,  'status' => 'cancelled'],
    ['id' => 5, 'customer' => 'Олег',  'total' => 2100, 'status' => 'done'],
];

// Выполненные заказы и выручка: array_filter + array_reduce
$done = array_values(array_filter($orders, fn(array $o): bool => $o['status'] === 'done'));
$revenue = array_reduce($done, fn(int $sum, array $o): int => $sum + $o['total'], 0);

// Заказы свыше 1000 руб. — строки
$big = array_map(
    fn(array $o): string => "Заказ №{$o['id']} — {$o['total']} руб. ({$o['customer']})",
    array_filter($orders, fn(array $o): bool => $o['total'] > 1000)
);

// Самый дорогой выполненный: usort копии и первый элемент
$sorted = $done; // копия
usort($sorted, fn(array $a, array $b): int => $b['total'] <=> $a['total']);
$top = $sorted[0];

// Уникальные имена клиентов: array_map + array_unique
$customers = array_values(array_unique(array_map(fn(array $o): string => $o['customer'], $orders)));

// Статистика
$countByStatus = fn(string $status): int => count(array_filter($orders, fn(array $o): bool => $o['status'] === $status));

echo "=== Отчёт по заказам ===" . PHP_EOL;
echo "Выручка по выполненным заказам: {$revenue} руб." . PHP_EOL . PHP_EOL;

echo "Заказы свыше 1000 руб.:" . PHP_EOL;
echo implode(PHP_EOL, $big) . PHP_EOL . PHP_EOL;

echo "Самый дорогой выполненный заказ: №{$top['id']} — {$top['total']} руб. ({$top['customer']})" . PHP_EOL . PHP_EOL;

echo 'Клиенты: ' . implode(', ', $customers) . PHP_EOL . PHP_EOL;

echo "Статистика:" . PHP_EOL;
echo 'Всего заказов: ' . count($orders) . PHP_EOL;
echo 'Выполнено: ' . $countByStatus('done') . PHP_EOL;
echo 'Отменено: ' . $countByStatus('cancelled') . PHP_EOL;
echo "Сумма выручки: {$revenue} руб." . PHP_EOL;
