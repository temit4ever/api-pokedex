<script setup>
import {onMounted, ref} from 'vue';
import PokemonTable from "./PokemonTable.vue";
const searchQuery = ref('');
const result = ref({});

const fetchPokemonByName = async () => {
    if (searchQuery.value.trim() !== '') {
        const name = searchQuery.value.toLowerCase()
        const tableRow = document.getElementsByTagName('tr').length
        let table = document.getElementById('list-table');
        if (tableRow > 0) {
            table.style.display = 'none'
        }
        try {
            const response = await axios.get('/api/v1/pokemon/' + name);
            if (response.data.data.length === 0 ) {
                throw new Error('No Pokemon found with that name');
            }

            result.value = response.data.data
        } catch (error) {
            console.error('Error fetching Pokemon:', error);
        }
    }
}
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
                       id="inline-password"
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
                    @click="fetchPokemonByName"
                >
                 Search
                </button>
            </div>
            <div v-if="result.length" class="pokemon-list mt-4" id="search-table">
                <PokemonTable :pokemonList="result"/>
            </div>
        </div>
</template>
