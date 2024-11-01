<?php

namespace App\Actions\Pokemon;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PokemonIndexAction
{
    public function handle(): LengthAwarePaginator
    {
        return Pokemon::orderBy('name')->paginate(50);

    }
}
