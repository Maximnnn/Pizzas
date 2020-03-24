<?php

namespace Tests\Feature\Repositories;

use App\Models\Ingredient;
use App\Models\Pizza;
use App\Repositories\PizzaRepository;
use App\Services\PizzaPriceCalculator;
use Tests\TestCase;

class PizzaRepositoryTest extends TestCase
{
    private $time;
    private $ingredients;
    /**
     * @var PizzaRepository
     */
    private $repo;

    public function setUp(): void
    {
        parent::setUp();
        $this->time = $time = (string)(time() + microtime(true));
        $ingredients = [
            ['name' => $time . 1, 'price' => rand(1,100)],
            ['name' => $time . 2, 'price' => rand(1,100)],
            ['name' => $time . 3, 'price' => rand(1,100)],
            ['name' => $time . 4, 'price' => rand(1,100)],
        ];

        $this->ingredients = array_map(function($ingredient) {
            return Ingredient::query()->create($ingredient);
        }, $ingredients);

        /**@var $repo PizzaRepository */
        $this->repo = new PizzaRepository(new Pizza(), new PizzaPriceCalculator());
    }

    public function testCreate()
    {
        $pizza = $this->createPizza();

        $this->assertInstanceOf(Pizza::class, $pizza);
        $this->assertEquals($this->time, $pizza->name);
        $this->assertEquals(array_column($this->ingredients, 'id'), array_column($pizza->ingredients()->get()->toArray(), 'id'));
    }

    private function createPizza()
    {
        return $this->repo->createWithIngredients($this->time, array_column($this->ingredients, 'id'));
    }

    public function testUpdate()
    {
        $pizza = $this->createPizza();

        $this->repo->updateIngredients($pizza, array_column([$this->ingredients[0], $this->ingredients[1]], 'id'));

        $this->assertEquals(array_column([$this->ingredients[0],$this->ingredients[1]], 'id'), array_column($pizza->ingredients()->get()->toArray(), 'id'));
    }
}
