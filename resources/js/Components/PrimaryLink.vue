<script setup>
const props = defineProps({
    to: {
        type: [String, Object],
        required: true,
    },
});
</script>

<template>
    <router-link :to="to" class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <slot />
    </router-link>
</template>
