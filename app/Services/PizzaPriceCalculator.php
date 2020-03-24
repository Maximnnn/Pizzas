<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ingredient;

class PizzaPriceCalculator implements PizzaPriceCalcInterface
{
    protected $ingredients = [];

    public function addIngredient(Ingredient $ingredient)
    {
        $this->ingredients[] = $ingredient;
    }

    public function calcPrice(): string
    {
        $net = array_reduce($this->ingredients, function($price, Ingredient $ingredient) {
            $price = bcadd($price, $ingredient->price,2);
            return $price;
        }, '0');

        return bcmul($net, '1.5', 2);
    }
}
