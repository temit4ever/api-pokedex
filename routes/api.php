<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/v1/pokemon', [PokemonController::class, 'index'])->name('api.pokemon.index');
Route::get('/v1/pokemon/{name}', [PokemonController::class, 'show']);
Route::get('/v2/pokemon/{id}', [PokemonController::class, 'showDetails']);


