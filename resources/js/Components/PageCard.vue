<script setup>
const props = defineProps({
    heading: {
        type: String,
    },
});
</script>

<template>
    <Teleport v-if="heading" to="#page-heading">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ heading }}</h2>
        </div>
    </Teleport>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <slot/>
                </div>
            </div>
        </div>
    </div>
</template>
