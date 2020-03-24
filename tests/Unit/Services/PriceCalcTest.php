<?php

namespace Tests\Unit\Services;

use App\Models\Ingredient;
use App\Services\PizzaPriceCalculator;
use PHPUnit\Framework\TestCase;

class PriceCalcTest extends TestCase
{
    public function testCalculator()
    {
        $calc = new PizzaPriceCalculator();
        $calc->addIngredient(new Ingredient(['price' => 10]));
        $calc->addIngredient(new Ingredient(['price' => 20]));

        $this->assertEquals('45.00', $calc->calcPrice());
    }
}
