<script setup>
import { ref, onMounted } from "vue";
import PageCard from "@/Components/PageCard.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import { DateTime } from 'luxon';

const props = defineProps({
    id: {
        type: String,
        required: true,
    },
});

const screening = ref([]);

// load initial data here
onMounted(async () => {
    try {
        const response = await axios.get(`/api/screenings/${props.id}`);
        screening.value = response.data;
        console.log('Screening data:', response.data);
    } catch (error) {
        console.error(error);
    }
})
</script>

<template>
    <PageCard heading="Screening: Show">
        <div class="space-y-4">
            <div class="flex flex-col sm:flex-row gap-4">
                <!-- Poster -->
                <a :href="screening.movie?.poster_url" class="block shrink-0">
                    <img :src="screening.movie?.poster_url" alt="Movie poster" class="w-full sm:w-48 md:w-60 object-cover" />
                </a>

                <!-- Details -->
                <div class="space-y-2">
                    <!-- Title -->
                    <h1 class="text-3xl font-semibold">{{ screening.movie?.title }}</h1>

                    <!-- Screening time -->
                    <p>
                        <span class="font-semibold text-red-700">Screening time:</span>
                        {{ DateTime.fromISO(screening.starts_at).toUTC().toLocaleString(DateTime.DATETIME_FULL) }}
                    </p>

                    <!-- Seats -->
                    <p>
                        <span class="font-semibold text-red-700">Seats:</span> {{ screening.seats }}
                    </p>

                    <!-- Edit button -->
                    <PrimaryLink :to="{ name: 'screenings.edit', params: { id:screening.id } }">Edit</PrimaryLink>
                </div>
            </div>
        </div>
    </PageCard>
</template>
