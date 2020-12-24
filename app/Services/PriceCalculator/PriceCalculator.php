<?php

namespace App\Services\PriceCalculator;

class PriceCalculator implements Calculator
{
    /**
     * @param array $products
     * @return int
     */
    public function calculate(array $products)
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $productPrice = round($product['price'] - ($product['price'] * $product['discount'] / 100), -3);
            $totalPrice += $productPrice * (int)$product['quantity'];
        }

        return $totalPrice;
    }
}
