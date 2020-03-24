<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ingredient;

interface PizzaPriceCalcInterface
{
    public function addIngredient(Ingredient $ingredient);

    public function calcPrice(): string;
}
