<?php

namespace App\Actions\Pokemon;

use App\Models\Pokemon;
use Illuminate\Pagination\LengthAwarePaginator;

class PokemonShowAction
{
   public function handle(string $name): LengthAwarePaginator
   {
       // Using Laravel scope here
       return Pokemon::getPokemonByName($name);
   }
}
