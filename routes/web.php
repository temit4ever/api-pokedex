<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokemon', [PokemonController::class, 'index'])->name('pokemon.index');

Route::get('/pokemon/{name}', [PokemonController::class, 'show'])->name('pokemon.show');
