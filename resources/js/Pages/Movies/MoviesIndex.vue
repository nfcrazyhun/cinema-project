<script setup>
import { ref, onMounted } from "vue";
import axios from 'axios';
import PageCard from "@/Components/PageCard.vue";
import MoviesGrid from "@/Components/MoviesGrid.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";

const moviesData = ref([]);

// load initial data here
onMounted(async () => {
    try {
        const response = await axios.get('/api/movies');
        moviesData.value = response.data;
        console.log('Movies data:', response.data);
    } catch (error) {
        console.error(error);
    }
})

</script>

<template>
    <PageCard heading="Movies: Index">
        <div class="space-y-4">
            <!-- Create button -->
            <PrimaryLink :to="{ name: 'movies.create' }">Create new movie</PrimaryLink>

            <!-- Movie grid -->
            <template v-if="Object.keys(moviesData).length > 0">
                <MoviesGrid :moviesData="moviesData"/>
            </template>
            <template v-else>
                <p>No movie data available.</p>
            </template>
        </div>
    </PageCard>
</template>
