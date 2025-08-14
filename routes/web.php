<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\{
    UserController,
    ClientController,
    BranchController
};
use App\Http\Controllers\Inventory\{
WarehouseController,
CategoryController,
ItemController,
StockController,
TransactionController
};    
use App\Http\Controllers\Operation\{
ContractController,
OrderController
};    

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {

    //Users Panel
    Route::prefix('users')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/create', [UserController::class, 'store'])->name('users.create');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    });
    //Clients Panel
    Route::prefix('client')->group(function(){
    Route::get('/', [ClientController::class, 'index'])->name('client.index');
    Route::post('/create', [ClientController::class, 'store'])->name('client.create');
    Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/update/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/delete/{id}', [ClientController::class, 'delete'])->name('client.delete');
    Route::get('/{id}/branches', [BranchController::class, 'index'])->name('branch.index');
    Route::post('/branches/create', [BranchController::class, 'store'])->name('branch.create');
    Route::get('/zones',[BranchController::class, 'getZones'])->name('zones.get');
    Route::get('/branches/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/branches/update/{id}', [BranchController::class, 'update'])->name('branch.update');
    });
    //Warehouses Panel
    Route::prefix('warehouse')->group(function(){
    Route::get('/', [WarehouseController::class, 'index'])->name('warehouse.index');
    Route::post('/create', [WarehouseController::class, 'store'])->name('warehouse.create');
    Route::get('/edit/{id}', [WarehouseController::class, 'edit'])->name('warehouse.edit');
    Route::put('/update/{id}', [WarehouseController::class, 'update'])->name('warehouse.update');
    Route::delete('/delete/{id}', [WarehouseController::class, 'delete'])->name('warehouse.delete');
    });
    //categories Panel
    Route::prefix('category')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/create', [CategoryController::class, 'store'])->name('category.create');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
    //items Panel
    Route::prefix('item')->group(function(){
    Route::get('/', [ItemController::class, 'index'])->name('item.index');
    Route::post('/create', [ItemController::class, 'store'])->name('item.create');
    Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/update/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/delete/{id}', [ItemController::class, 'delete'])->name('item.delete');
    });
    //transactions Panel
    Route::prefix('transaction')->group(function(){
    Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/create', [TransactionController::class, 'store'])->name('transaction.create');
    });
    //Stock Panel
    Route::get('/min_stock', [StockController::class, 'index'])->name('stock.index');
    //Contract Panel
    Route::prefix('contract')->group(function(){
    Route::get('/',[ContractController::class,'index'])->name('contract.index');
    Route::post('/create', [ContractController::class, 'store'])->name('contract.create');
    Route::get('/edit/{id}', [ContractController::class, 'edit'])->name('contract.edit');
    Route::put('/update/{id}', [ContractController::class, 'update'])->name('contract.update');
    Route::get('/{id}/pdf', [ContractController::class, 'showPdf'])->name('contract.pdf');
    Route::get('/{id}/pdf/download', [ContractController::class, 'download'])->name('contract.download');
    });
    //Work order Panel
    Route::prefix('work_order')->group(function (){
    Route::get('/',[OrderController::class,'index'])->name('order.index');
    Route::post('/create',[OrderController::class,'store'])->name('order.create');
    Route::get('/edit/{id}',[OrderController::class,'edit'])->name('order.edit');
    Route::get('/get/{id}',[OrderController::class,'getWorker'])->name('order.get');
    Route::post('order/{id}/create',[OrderController::class,'createWorker'])->name('order.create');
    }); 

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
