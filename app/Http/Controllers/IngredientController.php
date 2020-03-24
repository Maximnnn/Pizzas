<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateIngredientRequest;
use App\Models\Ingredient;
use App\Repositories\IngredientRepository;

class IngredientController extends Controller
{
    public function index()
    {
        return view('ingredientCreate');
    }

    public function create(IngredientRepository $ingredientRepository, CreateIngredientRequest $request)
    {
        return $ingredientRepository->create($request->validated());
    }

    public function getList()
    {
        return Ingredient::query()->paginate(20);
    }
}
