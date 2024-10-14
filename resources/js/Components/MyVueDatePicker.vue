<script setup>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const model = defineModel()
</script>
<template>
    <VueDatePicker
        v-model="model"
        model-type="iso"
        format="yyyy-MM-dd HH:mm"
        timezone="UTC"
        auto-apply
    />
</template>
