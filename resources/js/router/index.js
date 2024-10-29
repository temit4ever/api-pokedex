import { createRouter, createWebHistory } from 'vue-router';
import PokemonList from '../components/PokemonList.vue';
import PokemonDetails from '../components/PokemonDetails.vue';

const routes = [
    {
        path: '/',
        name: 'PokemonList',
        component: PokemonList,
    },
    {
        path: '/pokemon/:id',
        name: 'PokemonDetails',
        component: PokemonDetails,
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
