<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ingredient
 * @package App\Models
 *
 * @property $name string
 * @property $price string
 */
class Ingredient extends Model
{
    protected $table = 'ingredients';

    protected $fillable =  ['name', 'price'];

    public $timestamps = false;
}
