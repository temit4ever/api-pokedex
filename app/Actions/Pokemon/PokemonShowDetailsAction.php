<?php

namespace App\Actions\Pokemon;

use App\Models\Pokemon;

class PokemonShowDetailsAction
{
    public function handle($id)
    {
        return Pokemon::findorFail($id);
    }

}
