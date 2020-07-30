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
            $totalPrice += 111111;
        }

        return $totalPrice;
    }
}
