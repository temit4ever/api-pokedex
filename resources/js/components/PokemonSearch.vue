<script setup>
import {onMounted, ref} from 'vue';
import PokemonTable from "./PokemonTable.vue";
import usePokemon from '../composable/pokemone.js';
import Pagination from "./Pagination.vue";
const searchQuery = ref('');
const { pokemonByName, pokemonByNamePagination, fetchPokemonByName } = usePokemon();

onMounted(fetchPokemonByName);
</script>

<template>

        <div class="mb-6">
            <div class="md:w-1/3">
            </div>
            <div class="md:w-2/3">
                <input class="appearance-none
                border-2
                border-gray-200
                rounded w-full
                py-2 px-4
                text-gray-700
                leading-tight
                focus:outline-none
                focus:bg-white
                focus:border-purple-500"
                       id="search-id"
                       type="text"
                       v-model="searchQuery"
                       placeholder="Search for Pokemon by name">
            </div>
        </div>

        <div class="">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <button
                    class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                    type="button"
                    @click="fetchPokemonByName(1, searchQuery, $event)"
                >
                 Search
                </button>
            </div>
            <div v-if="pokemonByName.length" class="pokemon-list mt-4" id="search-table">
                <PokemonTable :pokemonList="pokemonByName" />
                <Pagination :pagination="pokemonByNamePagination" :fetchPokemon="fetchPokemonByName" />
            </div>
        </div>
</template>
