<?php


namespace App\Services\PriceCalculator;


use App\Models\Shop\Product;

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
            $totalPrice += ($product['price'] * (int)$product['quantity']);
        }

        return $totalPrice;
    }
}
