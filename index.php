<?php
$product = [
    'name' => 'Футболка',
    'price' => 1000,
    'stock' => 5
];

$priceThreshold = 1500;
$discountRate = 10;

if ($product['stock'] > 0 && $product['price'] < $priceThreshold) {
    $discountAmount = ($product['price'] * $discountRate) / 100;
    $finalPrice = $product['price'] - $discountAmount;
    echo "Товар {$product['name']} (оригинальная цена: {$product['price']} руб.) доступен для заказа. Ваша цена со скидкой: {$finalPrice} руб.";
}else{
    echo "Товара нет в наличии или он слишком дорогой";
}