<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreatePizzaRequest;
use App\Repositories\PizzaRepository;

class PizzaController extends Controller
{
    public function index()
    {
        return view('pizzaCreate');
    }

    public function create(PizzaRepository $pizzaRepository, CreatePizzaRequest $request)
    {
        return $pizzaRepository->createWithIngredients(
            $request->validated()['name'], $request->validated()['ingredients']
        );
    }
}
