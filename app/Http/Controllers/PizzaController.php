<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreatePizzaRequest;
use App\Http\Requests\UpdatePizzaRequest;
use App\Models\Pizza;
use App\Repositories\PizzaRepository;

class PizzaController extends Controller
{
    public function pizzaList()
    {
        return view('pizzaList', ['pizzas' => Pizza::query()->get()]);
    }

    public function pizza(Pizza $pizza)
    {
        return view('pizza', [
            'pizza' => $pizza,
            'ingredients' => $pizza->ingredients()->get()
        ]);
    }

    public function createPage()
    {
        return view('pizzaCreate');
    }

    public function create(PizzaRepository $pizzaRepository, CreatePizzaRequest $request)
    {
        return $pizzaRepository->createWithIngredients(
            $request->validated()['name'], $request->validated()['ingredients']
        );
    }

    public function update(PizzaRepository $pizzaRepository, UpdatePizzaRequest $request, Pizza $pizza)
    {
        return $pizzaRepository->updateIngredients($pizza, $request->validated()['ingredients']);
    }
}
