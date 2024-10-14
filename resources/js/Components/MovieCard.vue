<script setup>
import PrimaryLink from "@/Components/PrimaryLink.vue";

const props = defineProps({
    movie: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <div class="flex gap-4">
        <!-- Poster -->
        <a :href="movie.poster_url" class="shrink-0">
            <img :src="movie.poster_url" alt="Movie poster" class="w-24 sm:w-36 lg:w-48 object-cover" />
        </a>

        <!-- Details -->
        <div class="space-y-2">
            <!-- Title -->
            <router-link :to="{ name:'movies.show', params:{ id:movie.id } }">
                <h2 class="text-2xl font-semibold hover:underline">{{ movie.title }}</h2>
            </router-link>

            <!-- Rating, Language -->
            <p>{{ movie.rating }} | {{ movie.language }}</p>

            <!-- Description -->
            <p class="line-clamp-4 sm:line-clamp-6">{{ movie.description }}</p>

            <PrimaryLink :to="{ name:'movies.show', params:{id:movie.id} }">
                View details
            </PrimaryLink>
        </div>
    </div>
</template>
