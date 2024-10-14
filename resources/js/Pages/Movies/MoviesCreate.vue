<script setup>
import { ref } from 'vue';
import axios from 'axios';
import PageCard from "@/Components/PageCard.vue";
import router from "@/Router/index.js";
import { Rating } from "@/Enums/Rating.enum.js";
import { Language } from "@/Enums/Language.enum.js";

// Form inputs
const form = ref({
    title: '',
    description: '',
    rating: null,
    language: null,
    poster: null,
});

// Validation errors
const errors = ref({});
const success = ref('')

const submit = async () => {
    // reset messages before each request.
    errors.value = {};
    success.value = '';

    const formData = new FormData();
    formData.append('title', form.value.title);
    formData.append('description', form.value.description);
    formData.append('rating', form.value.rating);
    formData.append('language', form.value.language);
    if (form.value.poster) {
        formData.append('poster', form.value.poster);
    }

    try {
        const response = await axios.post('/api/movies', formData);
        console.log('Form submitted successfully:', response.data);
        await router.push({'name': 'movies.index'});
    } catch (error) {
        console.error('Error submitting form:', error);
        if (error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
    }
};
</script>

<template>
    <PageCard heading="Movies: Create">
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
