<script setup>
const props = defineProps({
    to: {
        type: [String, Object],
        required: true,
    },
});
</script>

<template>
    <router-link :to="to" class="nav-link">
        <slot />
    </router-link>
</template>
