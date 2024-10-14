<script setup>
import {ref, onMounted} from "vue";
import axios from 'axios';
import PageCard from "@/Components/PageCard.vue";
import ScheduleGrid from "@/Components/ScheduleGrid.vue";

const scheduleData = ref([]);

// load initial data here
onMounted(async () => {
    try {
        const response = await axios.get('/api/schedule');
        scheduleData.value = response.data;
        console.log('Schedule data:', response.data);
    } catch (error) {
        console.error(error);
    }
})

</script>

<template>
    <PageCard heading="Schedule: Index">
        <div class="space-y-2">
            <!-- Schedule grid -->
            <template v-if="Object.keys(scheduleData).length > 0">
                <ScheduleGrid :scheduleData="scheduleData"/>
            </template>
            <template v-else>
                <p>No schedule data available.</p>
            </template>
        </div>
    </PageCard>
</template>
