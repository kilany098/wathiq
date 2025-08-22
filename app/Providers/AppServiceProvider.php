<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\{
    stock,
    contract,
    request,
    work_order
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
        $pending_orders=count(work_order::where('status', '=', 'done')->get());
        $pending_req=count(request::where('status', '=', 'pending')->get());
        $stock = count(stock::where('quantity', '<', 15)->get());
        $new_contract = count(contract::where('status', '=', 'new')->get());
        View::share('stock_min', $stock);
        View::share('new_contract', $new_contract);
        View::share('pending_req', $pending_req);
        View::share('pending_orders', $pending_orders);
    }
}
