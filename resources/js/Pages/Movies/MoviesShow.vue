<script setup>
import { ref, onMounted } from "vue";
import PageCard from "@/Components/PageCard.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";

const props = defineProps({
    id: {
        type: String,
        required: true,
    },
});

const movie = ref([]);

// load initial data here
onMounted(async () => {
    try {
        const response = await axios.get(`/api/movies/${props.id}`);
        movie.value = response.data;
        console.log('Movie data:', response.data);
    } catch (error) {
        console.error(error);
    }
})
</script>

<template>
    <PageCard heading="Movies: Show">
        <div class="space-y-4">
            <div class="flex flex-col sm:flex-row gap-4">
                <!-- Poster -->
                <a :href="movie.poster_url" class="block shrink-0">
                    <img :src="movie.poster_url" alt="Movie poster" class="w-full sm:w-48 md:w-60 object-cover" />
                </a>

                <!-- Details -->
                <div class="space-y-2">
                    <!-- Title -->
                    <h1 class="text-3xl font-semibold">{{ movie.title }}</h1>

                    <!-- Rating -->
                    <p>
                        <span class="font-semibold text-red-700">Rating:</span> {{ movie.rating }}
                    </p>

                    <!-- Language-->
                    <p>
                        <span class="font-semibold text-red-700">Language:</span> {{ movie.language }}
                    </p>

                    <!-- Edit button -->
                    <PrimaryLink :to="{ name: 'movies.edit', params: { id:movie.id } }">Edit</PrimaryLink>
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <p class="text-xl font-semibold text-red-700">Description</p>
                <p>{{ movie.description }}</p>
            </div>
        </div>
    </PageCard>
</template>
