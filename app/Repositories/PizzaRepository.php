<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Ingredient;
use App\Models\Pizza;
use App\Models\PizzaIngredient;
use App\Services\PizzaPriceCalcInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PizzaRepository extends Repository
{
    /**
     * @var PizzaPriceCalcInterface
     */
    private $pizzaPriceCalc;

    public function __construct(Model $model, PizzaPriceCalcInterface $pizzaPriceCalc)
    {
        parent::__construct($model);
        $this->pizzaPriceCalc = $pizzaPriceCalc;
    }

    public function createWithIngredients(string $name, array $ingredientIds): Pizza
    {
        $pizzaIngredients = $this->preparePizzaIngredients($ingredientIds);
        $price = $this->preparePrice($ingredientIds);

        return DB::transaction(function() use ($name, $pizzaIngredients, $price) {
            /**@var $pizza Pizza */
            $pizza = $this->create([
                'name' => $name,
                'price' => $price
            ]);

            $pizza->pizzaIngredients()->saveMany($pizzaIngredients);

            return $pizza;
        });
    }

    private function preparePrice(array $ingredientIds): string
    {
        foreach (Ingredient::query()->whereIn('id', $ingredientIds)->get() as $ingredient) {
            $this->pizzaPriceCalc->addIngredient($ingredient);
        }

        return $this->pizzaPriceCalc->calcPrice();
    }

    private function preparePizzaIngredients(array $ingredientIds): array
    {
        return array_map(function($ingredientId) {
            return new PizzaIngredient(['ingredient_id' => $ingredientId]);
        }, $ingredientIds);
    }
}
