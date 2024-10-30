<?php

namespace App\Services;

use App\Models\Pokemon;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\get;

class MakeRequestToPokeAPIService
{
    protected string $base_url;
    protected int $retry = 5;
    public function __construct()
    {
        $this->base_url = config('pokemon.default.base_url');
    }

    /**
     * @return string
     * @throws ConnectionException
     */
    public function getPokemonList(): string
    {
        $limit = config('pokemon.default.limit');
        $offset = config('pokemon.default.offset');
        $is_cache_empty = false;
        if (empty(Cache::get('all_pokemon'))) {
            $is_cache_empty = true;
            Cache::remember('all_pokemon', 86400, function () use ($limit, $offset) {
                $pokemon_data = [];
                $total_pokemon = config('pokemon.default.total_count');
                while ($offset < $total_pokemon) {
                    try {
                        $response = $this->getAllPokemonApiCall($limit, $offset);
                        if (empty($response["results"])) {
                            continue;
                        }
                        // Append more results to the pokemon_data array
                        $pokemon_data = array_merge($pokemon_data, $response["results"]);

                        // Increase the offset to fetch next batch of result
                        $offset += $limit;
                    } catch (Exception $ex) {
                        echo $ex->getMessage();
                    }
                }

                return $pokemon_data;
            });

            $this->processAPIResources(Cache::get('all_pokemon'));
        }

        if ($is_cache_empty) {
            return 'Fetching data from PokeAPI completed successfully and saved Pokemon details in the database';
        }

        return 'Not yet time to refresh data';

    }

    public function setHeader(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Content-Length' => 0,
        ];
    }

    /**
     * @throws ConnectionException
     */
    public function processAPIResources(array $pokemon_data): void
    {
        // Empty table record before pulling in fresh data from the API
        if (Pokemon::getOnePokemonId()->isNotEmpty()) {
            Pokemon::deleteAllPokemon();
        }

        foreach ($pokemon_data as $pokemon) {
            $pokemon_details = $this->getPokemonDetailsApiCall($pokemon['name']);
            if (empty($pokemon_details)) {
                continue;
            }
            $abilities = $this->extractAbilities($pokemon_details['abilities']);
            $types = $this->extractTypes($pokemon_details['types']);

            Pokemon::create([
                'name' => ucfirst($pokemon_details["name"]),
                'ability' => $abilities,
                'type' => $types,
                'weight' => $pokemon_details["weight"],
                'height' => $pokemon_details["height"],
                'image' => $pokemon_details["sprites"]["other"]["home"]["front_default"] ?? $pokemon_details["sprites"]["front_default"] ?? null ,
            ]);
        }
    }

    public function extractAbilities(array $abilities): string
    {
        $abilities_name = array_map(fn($ability) => ucfirst($ability['ability']['name']), $abilities);
        return implode(', ', $abilities_name);
    }

    public function extractTypes(array $types): string
    {
        $type_name = array_map(fn($type) => ucfirst($type['type']['name']), $types);
        return implode(', ', $type_name);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array|mixed
     * @throws ConnectionException
     */
    function getAllPokemonApiCall(int $limit, int $offset): mixed
    {
        return Http::withHeaders($this->setHeader())
            ->retry((int)$this->retry)
            ->baseUrl($this->base_url)
            ->withQueryParameters(
                [
                    'limit' => $limit,
                    'offset' => $offset,
                ]
            )
            ->get('')
            ->json();
    }

    /**
     * @param string $name
     * @return array|mixed
     * @throws ConnectionException
     */
    public function getPokemonDetailsApiCall(string $name): mixed
    {
        return Http::withHeaders($this->setHeader())
            ->retry((int)$this->retry)
            ->baseUrl($this->base_url . $name)
            ->get('')
            ->json();
    }
}
