<?php

use App\Http\Controllers\NytBestSellerController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/api/1/nyt/best-sellers', NytBestSellerController::class)
    ->name('bestsellers');

//require __DIR__.'/auth.php';
