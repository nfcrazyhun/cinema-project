<script setup>
import PrimaryLink from "@/Components/PrimaryLink.vue";
import {DateTime} from 'luxon';

const props = defineProps({
    movie: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="flex flex-col justify-between gap-2 hover:bg-gray-100 sm:flex-row">
        <!-- Movie -->
        <div class="flex gap-2">
            <!-- Poster -->
            <a :href="movie.poster_url">
                <img :src="movie.poster_url" alt="Movie poster" class="w-20 object-cover" />
            </a>

            <!-- Details -->
            <div>
                <!-- Title -->
                <router-link :to="{ name:'movies.show', params:{ id:movie.id } }">
                    <h2 class="text-xl font-semibold hover:underline">{{ movie.title }}</h2>
                </router-link>

                <!-- Rating -->
                <p>{{ movie.rating }}</p>
            </div>
        </div>

        <!-- Screening times -->
        <div class="flex items-center gap-2">
            <template v-for="screening in movie.screenings">
                <PrimaryLink :to="{ name:'screenings.show', params:{ id:screening.id } }">
                    {{ DateTime.fromISO(screening.starts_at).toUTC().toFormat('HH:mm') }}
                </PrimaryLink>
            </template>
        </div>
    </div>
</template>
