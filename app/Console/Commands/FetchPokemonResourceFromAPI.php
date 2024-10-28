<?php

namespace App\Console\Commands;

use App\Repositories\PokemonRepository;
use App\Services\MakeRequestToPokeAPIService;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;

class FetchPokemonResourceFromAPI extends Command
{
    protected $signature = 'pokemon:fetch-data';
    protected $description = 'Fetch and store specific Pokemon data from the PokeAPI';


    /**
     * Execute the console command.
     * @throws ConnectionException
     */
    public function handle(): void
    {
        $pokemonApiService = new MakeRequestToPokeAPIService();
        $this->info('Fetching Pokemon data from PokeAPI --------');
        $pokemonApiService->getPokemonList();
        $this->info("Fetching data from PokeAPI completed successfully and saved Pokemon details in the database");
    }
}
