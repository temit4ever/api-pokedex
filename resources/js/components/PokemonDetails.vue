<template>
    <div class="ml-3 mb-2.5" >
        <button @click="goBack" class="btn btn-secondary mt-3">Back to List</button>
    </div>
    <div v-if="pokemon" class="card lg:justify-center lg:col-start-2">
        <div class="card-body">
            <div><span class="text-indigo-400 text-4xl">Name</span> - <span class="text-3xl">{{ pokemon.name }}</span></div>
            <div><span class="text-indigo-400 text-4xl">Abilities</span> - <span class="text-3xl">{{ pokemon.ability }}</span></div>
            <div><span class="text-indigo-400 text-4xl">Type</span> - <span class="text-3xl">{{ pokemon.type }}</span></div>
            <div><span class="text-indigo-400 text-4xl">Height</span> - <span class="text-3xl">{{ pokemon.height }}</span></div>
            <div><span class="text-indigo-400 text-4xl">Weight</span> - <span class="text-3xl">{{ pokemon.weight }}</span></div>

            <div>
                <img class="flex" :src="pokemon.image" alt="Pokemon image" v-if="pokemon.image"/>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const pokemon = ref({});

const fetchPokemonDetails = async () => {
    try {
        console.log(route.params)
        const response = await axios.get(`/api/v2/pokemon/${route.params.id}`);
        pokemon.value = response.data;
        console.log(response.data)
    } catch (error) {
        console.error('Error fetching Pokémon details:', error);
    }

};

const goBack = () => {
    router.push({ name: 'PokemonList' });
};
onMounted(fetchPokemonDetails);
</script>
