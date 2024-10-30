<?php

use App\Services\MakeRequestToPokeAPIService;

beforeEach(function () {
    // Create a mock of the PokemonService class
    $this->mock = Mockery::mock(MakeRequestToPokeAPIService::class);

    $this->name = 'bulbasaur';
    $this->base_url = config('pokemon.default.base_url');
    $this->mock_data = [
        "count" => 1302,
        "next" => "https://pokeapi.co/api/v2/pokemon/?offset=3&limit=3",
        "previous" => null,
        "results" => [
            [
                "name" => "bulbasaur",
                "url" => "https://pokeapi.co/api/v2/pokemon/1/"
            ],
            [
                "name" => "ivysaur",
                "url" => "https://pokeapi.co/api/v2/pokemon/2/"
            ],
            [
                "name" => "venusaur",
                "url" => "https://pokeapi.co/api/v2/pokemon/3/"
            ]
        ]
    ];

    $this->mock_detail = [
        'abilities' => [
            "ability" => [
                "name" => "synchronize",
                "url" => "https://pokeapi.co/api/v2/ability/28/"
            ],
        ],
        "is_hidden" => false,
        "slot" => 1
    ];
});

it("can get the list of all available Pokemon's name using the mocked service", function () {
    $actual = app(MakeRequestToPokeAPIService::class)->getAllPokemonApiCall(3, 0);
    $this->mock
        ->shouldReceive('getAllPokemonApiCall')
        ->once()
        ->with(3, 0)
        ->andReturn($this->mock_data);
    $expected = $this->mock->getAllPokemonApiCall(3, 0);
    $this->assertEquals($expected, $actual);
    $this->assertIsArray($actual);
    $this->assertIsArray($expected);
    $this->assertArrayHasKey('results', $expected);
    $this->assertArrayHasKey('results', $actual);
});

it("can get the list of specific Pokemon's by name using the mocked service", function () {
    $actual = app(MakeRequestToPokeAPIService::class)->getPokemonDetailsApiCall($this->name);
    $this->mock
        ->shouldReceive('getPokemonDetailsApiCall')
        ->once()
        ->with($this->name)
        ->andReturn($this->mock_detail);
    $expected = $this->mock->getPokemonDetailsApiCall($this->name);
    $this->assertIsArray($actual);
    $this->assertIsArray($expected);
    $this->assertArrayHasKey('abilities', $expected);
    $this->assertArrayHasKey('abilities', $actual);
});


