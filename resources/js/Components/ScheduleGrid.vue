<script setup>
import ScheduleCard from "@/Components/ScheduleCard.vue";

const props = defineProps({
    scheduleData: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="space-y-4">
        <template v-for="(movies, date) in scheduleData" :key="date">
            <div>
                <!-- Date -->
                <div class="border-b-2 border-red-700 mb-2">
                    <h2 class="text-2xl font-semibold">{{ date }}</h2>
                </div>

                <!-- Movie schedule of the day -->
                <div class="space-y-2">
                    <template v-for="movie in movies" :key="date+'_'+movie.id">
                        <!-- Schedule card -->
                        <ScheduleCard :movie="movie"/>
                    </template>
                </div>
            </div>
        </template>
    </div>
</template>
