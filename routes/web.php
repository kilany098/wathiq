<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\{
    UserController,
    ClientController
};

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {

    //Users Panel
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/create', [UserController::class, 'store'])->name('users.create');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    //Clients Panel
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::post('/client/create', [ClientController::class, 'store'])->name('client.create');
    Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/client/update/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/client/delete/{id}', [ClientController::class, 'delete'])->name('client.delete');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
