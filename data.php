<?php

declare(strict_types=1);

require_once __DIR__ . '/src/Category.php';
require_once __DIR__ . '/src/Product.php';



$categoryObjects = [
    new Category(1, 'Bàn phím', 'Danh mục bàn phím'),
    new Category(2, 'Chuột', 'Danh mục chuột'),
    new Category(3, 'Màn hình', 'Danh mục màn hình'),
];


$productObjects = [
    new Product('KB-01', 'Keychron K2',      1, 1890000, 3),
    new Product('KB-02', 'Akko 3087',        1, 1290000, 5),
    new Product('KB-03', 'Leopold FC660M',   1, 2750000, 2),
    new Product('MS-01', 'Logitech M331',    2, 290000, 10),
    new Product('MS-02', 'Razer Viper',      2, 990000, 4),
    new Product('MS-03', 'Xiaomi Silent',    2, 250000, 8),
    new Product('MN-01', 'Dell 24 inch',     3, 3200000, 2),
    new Product('MN-02', 'LG UltraFine',     3, 8500000, 1),
];

$categoryMap = [];

foreach ($categoryObjects as $cat) {
    $categoryMap[$cat->id] = $cat->name;
}

function inventoryValueFromObjects(array $products): int
{
    $sum = 0;

    foreach ($products as $product) {
        $sum += $product->lineTotal();
    }

    return $sum;
}

$totalInventory = inventoryValueFromObjects($productObjects);