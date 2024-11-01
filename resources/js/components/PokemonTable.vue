<script setup>
import { useRouter } from "vue-router";
const router = useRouter();
const props = defineProps({
    pokemonList: Object,
})
const viewDetails = (id) => {
    router.push({ name: 'PokemonDetails', params: { id } });
};
</script>
<template>
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="pokemonList.length > 0"  v-for="pokemon in pokemonList" :key="pokemon.id">
            <td>{{ pokemon.name }}</td>
            <td>{{ pokemon.type }}</td>
            <td>
                <button class="btn btn-primary btn-sm" @click="viewDetails(pokemon.id)">
                    View Details
                </button>
            </td>
        </tr>
        <tr v-else>
            <td colspan="6" class="text-center"><span class="text-2xl text-indigo-500">No results found ...</span></td>
        </tr>
        </tbody>
        <tbody>
        </tbody>
    </table>
</template>
