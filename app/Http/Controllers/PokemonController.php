<?php

namespace App\Http\Controllers;

use App\Repositories\PokemonRepository;
use App\Services\MakeRequestToPokeAPIService;
use Illuminate\Http\JsonResponse;

class PokemonController extends Controller
{
    public function __construct(
        protected PokemonRepository $pokemonRepository,
        protected MakeRequestToPokeAPIService $service
    ){}

    /**
     */
    public function index(): JsonResponse
    {
        $result = $this->pokemonRepository->getAllPokemon();
        return response()->json($result);
    }
   public function show($pokemon): JsonResponse
   {
      $result = $this->pokemonRepository->getPokemonByName($pokemon);
      return response()->json($result);
   }

   public function showDetails($pokemon): JsonResponse
   {
       $result = $this->pokemonRepository->getPokemonById($pokemon);
       return response()->json($result);
   }
}
