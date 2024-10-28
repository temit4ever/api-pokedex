<?php

namespace App\Http\Controllers;

use App\Repositories\PokemonRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PokemonController extends Controller
{
    public function __construct(protected PokemonRepository $pokemonRepository)
    {
    }

    /**
     */
    public function index(): LengthAwarePaginator
    {
        return $this->pokemonRepository->getAllPokemon();
    }
   public function show($pokemon)
   {
       return $this->pokemonRepository->getPokemonByName($pokemon);
   }
}
