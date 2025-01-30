<?php

use App\Http\Controllers\BreedController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/get-breeds', [BreedController::class, 'index'])->name('get.breeds');
Route::get('/search-breed', [BreedController::class, 'searchBreed'])->name('search.breed');
Route::get('/breed-details/{id}', [BreedController::class, 'getBreed'])->name('breed.details');
