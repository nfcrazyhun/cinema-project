<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/Navigation/components/ApplicationLogo.vue';
import NavLink from '@/Components/Navigation/components/NavLink.vue';
import ResponsiveNavLink from '@/Components/Navigation/components/ResponsiveNavLink.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <nav class="border-b border-gray-100 bg-gradient-to-r from-blue-50 to-red-50">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center gap-2">
                        <a href="/">
                            <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800"/>
                        </a>
                        <div class="text-2xl font-semibold text-gray-800">Cinema API</div>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:ms-10 sm:-my-px sm:flex">
                        <NavLink :to="{ name:'home' }">Home</NavLink>
                        <NavLink :to="{ name:'movies.index' }">Movies</NavLink>
                        <NavLink :to="{ name:'screenings.index' }">Screenings</NavLink>
                        <NavLink :to="{ name:'schedule.index' }">Schedule</NavLink>
                        <NavLink to="/docs/api" target="_blank">API</NavLink>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="flex items-center -me-2 sm:hidden">
                    <button
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
            :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
            class="bg-white sm:hidden"
        >
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :to="{ name:'home' }">Home</ResponsiveNavLink>
                <ResponsiveNavLink :to="{ name:'movies.index' }">Movies</ResponsiveNavLink>
                <ResponsiveNavLink :to="{ name:'screenings.index' }">Screenings</ResponsiveNavLink>
                <ResponsiveNavLink :to="{ name:'schedule.index' }">Schedule</ResponsiveNavLink>
                <ResponsiveNavLink to="/docs/api" target="_blank">API</ResponsiveNavLink>
            </div>
        </div>
    </nav>
</template>
