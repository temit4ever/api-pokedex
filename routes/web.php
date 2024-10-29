<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokemon/api', [PokemonController::class, 'index']);

//Route::get('/pokemon/{id}', [PokemonController::class, 'showDetails']);
