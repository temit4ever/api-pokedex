<?php

namespace App\Repositories;

use App\Actions\Pokemon\PokemonIndexAction;
use App\Actions\Pokemon\PokemonShowAction;
use App\Interfaces\PokemonRepositoryInterface;
use App\Models\Pokemon;
use Illuminate\Pagination\LengthAwarePaginator;

class PokemonRepository implements PokemonRepositoryInterface
{
    public function __construct(protected PokemonShowAction $action, protected PokemonIndexAction $indexAction)
    {
    }


    /**
     * @return Pokemon
     */
    public function getAllPokemon(): LengthAwarePaginator
    {
       return $this->indexAction->handle();
    }

    public function getPokemonByName($name): LengthAwarePaginator
    {
        return $this->action->handle($name);
    }
}
