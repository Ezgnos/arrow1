<?php
declare(strict_types=1);

// Задача 4. Сортировка и вложенные стрелочные функции

$students = [
    ['name' => 'Анна',  'grade' => 4.5],
    ['name' => 'Борис', 'grade' => 3.2],
    ['name' => 'Вера',  'grade' => 4.8],
    ['name' => 'Глеб',  'grade' => 2.9],
];

// Копия для сортировки по алфавиту (массивы в PHP копируются по значению)
$byName = $students;

// 1) По убыванию оценки: меняем $a и $b местами в <=>
usort($students, fn(array $a, array $b): int => $b['grade'] <=> $a['grade']);

echo 'Рейтинг:' . PHP_EOL;
echo implode(PHP_EOL, array_map(
    fn(int $i, array $s): string => ($i + 1) . ". {$s['name']} — {$s['grade']}",
    array_keys($students),
    $students
)) . PHP_EOL . PHP_EOL;

// 2) По алфавиту — strcmp
usort($byName, fn(array $a, array $b): int => strcmp($a['name'], $b['name']));
echo 'По алфавиту: ' . implode(', ', array_map(fn(array $s): string => $s['name'], $byName)) . PHP_EOL . PHP_EOL;

// 3) Вложенная fn: функция, возвращающая функцию
$greaterThan = fn(float $limit) => fn(array $student): bool => $student['grade'] > $limit;

$good = array_values(array_filter($students, $greaterThan(4.0)));
echo 'Оценка выше 4.0: ' . implode(', ', array_map(fn(array $s): string => $s['name'], $good)) . PHP_EOL;

// 4) Количество
echo 'Количество: ' . count($good) . PHP_EOL;
