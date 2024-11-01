<script setup>
import { Bootstrap5Pagination } from 'laravel-vue-pagination';

const props = defineProps({
    pagination: Object,
    fetchPokemon: Function
});
</script>

<template>
<div>
    <Bootstrap5Pagination :data="pagination" @pagination-change-page="fetchPokemon"/>
</div>
</template>

<style scoped>
</style>
