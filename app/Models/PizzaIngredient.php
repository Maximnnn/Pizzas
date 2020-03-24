<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PizzaIngredient extends Model
{
    protected $table = 'pizza_ingredients';

    protected $fillable = ['pizza_id', 'ingredient_id'];

    public $timestamps = false;
}
