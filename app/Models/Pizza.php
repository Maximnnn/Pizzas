<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $table = 'pizzas';

    protected $fillable = ['name', 'price'];

    public function ingredients()
    {
        return $this->hasManyThrough(Ingredient::class, PizzaIngredient::class,
            'pizza_id', 'id', 'id', 'ingredient_id');
    }

    public function pizzaIngredients()
    {
        return $this->hasMany(PizzaIngredient::class);
    }
}
