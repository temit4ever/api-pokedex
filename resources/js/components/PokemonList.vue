<script setup>
import { onMounted } from "vue";
import PokemonTable from "./PokemonTable.vue";
import PokemonSearch from "./PokemonSearch.vue";
import Pagination from "./Pagination.vue";
import usePokemon from '../pokemone.js'

const { pokemonList, pokemonPagination, fetchPokemon } = usePokemon()

onMounted(fetchPokemon);
</script>
<template>
    <PokemonSearch v-if="pokemonList.length" />
    <div class="pokemon-list mt-4" id="list-table">
        <PokemonTable :pokemonList="pokemonList"/>
        <Pagination :pagination="pokemonPagination" :fetchPokemon="fetchPokemon" />
    </div>
</template>
