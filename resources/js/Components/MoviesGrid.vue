<script setup>
import MovieCard from "@/Components/MovieCard.vue";

const props = defineProps({
    moviesData: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <template v-for="movie in moviesData" :key="movie.id">
            <!-- Movie card -->
            <MovieCard :movie="movie"/>
        </template>
    </div>
</template>
