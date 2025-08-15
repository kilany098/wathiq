<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\{stock,
 contract   
};


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
$stock=count(stock::where('quantity','<',15)->get());
$new_contract=count(contract::where('status','=','new')->get());
    View::share('stock_min', $stock);
    View::share('new_contract', $new_contract);
    }
}
