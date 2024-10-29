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
        <tr v-for="pokemon in pokemonList" :key="pokemon.id">
            <td>{{ pokemon.name }}</td>
            <td>{{ pokemon.type }}</td>
            <td>
                <button class="btn btn-primary btn-sm" @click="viewDetails(pokemon.id)">
                    View Details
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</template>
