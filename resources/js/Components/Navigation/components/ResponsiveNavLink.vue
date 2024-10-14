<script setup>
const props = defineProps({
    to: {
        type: [String, Object],
        required: true,
    },
});
</script>

<template>
    <router-link :to="to" class="responsive-nav-link">
        <slot />
    </router-link>
</template>
