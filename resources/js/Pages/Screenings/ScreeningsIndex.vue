<script setup>
import { ref, onMounted } from "vue";
import axios from 'axios';
import PageCard from "@/Components/PageCard.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";

const screeningsData = ref([]);

// load initial data here
onMounted(async () => {
    try {
        const response = await axios.get('/api/screenings');
        screeningsData.value = response.data;
        console.log('Movies data:', response.data);
    } catch (error) {
        console.error(error);
    }
})
</script>

<template>
    <PageCard heading="Screenings: Index">
        <div class="space-y-4">
            <!-- Create button -->
            <PrimaryLink :to="{ name: 'screenings.create' }">Create new screening</PrimaryLink>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left rtl:text-right text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Movie title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Screening time
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Seats
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="screening in screeningsData" :key="screening.id" class="border-b bg-white hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                            <!-- ID -->
                            <td class="px-6 py-4">
                                {{ screening.id }}
                            </td>

                            <!-- Movie title -->
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                <router-link :to="{ name: 'movies.show', params: { id: screening.movie.id } }" class="hover:underline">{{ screening.movie.title }}</router-link>
                            </td>

                            <!-- Starts at -->
                            <td class="px-6 py-4">
                                {{ new Date(screening.starts_at).toLocaleString() }}
                            </td>

                            <!-- Seats -->
                            <td class="px-6 py-4">
                                {{ screening.seats }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right text-blue-600">
                                <router-link :to="{ name: 'screenings.edit', params: { id: screening.id } }" class="hover:underline">Edit</router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </PageCard>
</template>
