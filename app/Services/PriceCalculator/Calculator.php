<?php


namespace App\Services\PriceCalculator;


interface Calculator
{
    /**
     * @param array $products
     * @return int
     */
    public function calculate(array $products);
}
