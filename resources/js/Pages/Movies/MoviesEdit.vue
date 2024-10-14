<script setup>
import { ref, onMounted} from 'vue';
import axios from 'axios';
import PageCard from "@/Components/PageCard.vue";
import router from "@/Router/index.js";
import {Rating} from "@/Enums/Rating.enum.js";
import {Language} from "@/Enums/Language.enum.js";

const props = defineProps({
    id: {
        type: String,
        required: true,
    },
});

// Form inputs
const form = ref({
    title: '',
    description: '',
    rating: '',
    language: '',
    poster: null,
});

// Validation errors
const errors = ref({});
const success = ref('')

// load initial data here
onMounted(async () => {
    try {
        const response = await axios.get(`/api/movies/${props.id}`);
        form.value = response.data;
        console.log('Movie data:', response.data);
    } catch (error) {
        console.error(error);
    }
})

const submit = async () => {
    // reset messages before each request.
    errors.value = {};
    success.value = '';

    const formData = new FormData();
    formData.append('_method', 'PATCH');
    formData.append('title', form.value.title);
    formData.append('description', form.value.description);
    formData.append('rating', form.value.rating);
    formData.append('language', form.value.language);
    if (form.value.poster) {
        formData.append('poster', form.value.poster);
    }

    try {
        const response = await axios.post(`/api/movies/${props.id}`, formData);
        console.log('Form submitted successfully:', response.data);
        await router.push({ name: 'movies.show', params: { id: props.id } });
    } catch (error) {
        console.error('Error submitting form:', error);
        if (error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
    }
};

const deleteMovie = async () => {
    if (window.confirm('Are you sure you want to delete this movie?')) {
        try {
            await axios.delete(`/api/movies/${props.id}`);
            console.log('Movie deleted successfully');
            await router.push({ name: 'movies.index' });
        } catch (error) {
            console.error('Error deleting movie:', error);
        }
    }
};
</script>

<template>
    <PageCard heading="Movies: Edit">
        <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input v-model="form.title" type="text" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea v-model="form.description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <!-- Rating -->
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <select v-model="form.rating" id="rating" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="null" disabled>Select...</option>
                    <option v-for="option in Rating" :key="option" :value="option">{{ option }}</option>
                </select>
            </div>

            <!-- Language -->
            <div>
                <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
                <select v-model="form.language" id="language" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="null" disabled>Select...</option>
                    <option v-for="option in Language" :key="option" :value="option">{{ option }}</option>
                </select>
            </div>

            <!-- Poster -->
            <div>
                <label for="poster" class="block text-sm font-medium text-gray-700">Poster</label>
                <input @change="e => form.poster = e.target.files[0]" type="file" id="poster" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Actions -->
            <div class="flex justify-between">
                <!-- Submit button -->
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Submit
                </button>

                <!-- Delete button -->
                <button type="button" @click="deleteMovie" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Delete
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
