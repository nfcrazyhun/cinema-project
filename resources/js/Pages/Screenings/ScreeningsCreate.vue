<script setup>
import {onMounted, ref} from 'vue';
import axios from 'axios';
import PageCard from "@/Components/PageCard.vue";
import router from "@/Router/index.js";
import MyVueDatePicker from "@/Components/MyVueDatePicker.vue";

// Form inputs
const form = ref({
    movie_id: null,
    starts_at: '',
    seats: '',
});

// Validation errors
const errors = ref({});
const success = ref('')

const moviesData = ref([]);

onMounted(async () => {
    try {
        const response = await axios.get('/api/movies');
        moviesData.value = response.data;
        console.log('Movies data:', response.data);
    } catch (error) {
        console.error(error);
    }
})



const submit = async () => {
    // reset messages before each request.
    errors.value = {};
    success.value = '';

    const formData = new FormData();
    formData.append('movie_id', form.value.movie_id);
    formData.append('starts_at', form.value.starts_at);
    formData.append('seats', form.value.seats);

    try {
        const response = await axios.post('/api/screenings', formData);
        console.log('Form submitted successfully:', response.data);
        await router.push({'name': 'screenings.index'});
    } catch (error) {
        console.error('Error submitting form:', error);
        if (error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
    }
};
</script>

<template>
    <PageCard heading="Screenings: Create">
        <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
            <!-- Movie id -->
            <div>
                <label for="movie_id" class="block text-sm font-medium text-gray-700">Movie</label>
                <select v-model="form.movie_id" id="movie_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="null" disabled>Select...</option>
                    <option v-for="option in moviesData" :key="option" :value="option.id">{{ option.title }}</option>
                </select>
            </div>

            <!-- Stars at -->
            <div>
                <label for="starts_at" class="block text-sm font-medium text-gray-700">Starts at</label>
                <MyVueDatePicker v-model="form.starts_at" id="starts_at"/>
            </div>

            <!-- Seats -->
            <div>
                <label for="seats" class="block text-sm font-medium text-gray-700">Seats</label>
                <input v-model="form.seats" type="number" id="seats" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Submit button -->
            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Submit
                </button>
            </div>
        </form>

        <!-- validation errors -->
        <div v-show="Object.keys(errors).length" class="mt-4 border border-red-500 bg-red-50 p-2 text-red-700">
            <ul v-for="error in errors" class="ml-2 list-inside list-disc">
                <li>{{ error }}</li>
            </ul>
        </div>
    </PageCard>
</template>
