<script setup>
import {onMounted, ref} from "vue";
import PokemonTable from "./PokemonTable.vue";
import PokemonSearch from "./PokemonSearch.vue";

const pokemonList = ref([]);
const props = defineProps({
    pokemonList: Object
})

const fetchPokemon = async () => {
    try {
        const response = await axios.get('/api/v1/pokemon');
        pokemonList.value = response.data.data;
    } catch (error) {
        console.error('Error fetching Pokemon:', error);
    }
};

onMounted(fetchPokemon);
</script>
<template>
    <PokemonSearch v-if="pokemonList.length" />
    <div v-if="pokemonList.length" class="pokemon-list mt-4" id="list-table">
        <PokemonTable :pokemonList="pokemonList"/>
    </div>
</template>
