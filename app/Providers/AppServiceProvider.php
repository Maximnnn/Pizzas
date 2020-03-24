<?php

namespace App\Providers;

use App\Models\Ingredient;
use App\Models\Pizza;
use App\Repositories\IngredientRepository;
use App\Repositories\PizzaRepository;
use App\Services\PizzaPriceCalcInterface;
use App\Services\PizzaPriceCalculator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PizzaPriceCalcInterface::class, PizzaPriceCalculator::class);

        $this->app->bind(IngredientRepository::class, function() {
            return new IngredientRepository(new Ingredient());
        });
        $this->app->bind(PizzaRepository::class, function() {
            return new PizzaRepository(new Pizza(), app()->make(PizzaPriceCalcInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
