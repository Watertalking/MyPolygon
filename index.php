<?php
$product = [
    'title' => 'Футболка',
    'price' => 1000,
    'count' => 5
];

if ($product['count'] > 0 && $product['price'] < 1500) {
    $product['price'] -= $product['price'] * 0.1;
    echo "Товар {$product['title']} доступен для заказа. Цена со скидкой: {$product['price']}";
}else{
    echo "Товара нет в наличии или он слишком дорогой";
}