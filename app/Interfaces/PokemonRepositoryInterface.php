<?php

namespace App\Interfaces;

interface PokemonRepositoryInterface
{
    public function getAllPokemon();
    public function getPokemonByName(string $name);

}
