<script setup>
import Navigation from "@/Components/Navigation/Navigation.vue";
</script>

<template>
    <div class="flex flex-col min-h-screen bg-gray-100">
        <!-- Navigation -->
        <Navigation />

        <!-- Page Heading -->
        <header id="page-heading" class="bg-white shadow"></header>

        <!-- Page Content -->
        <main>
            <router-view />
        </main>
    </div>
</template>
