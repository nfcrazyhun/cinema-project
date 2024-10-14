import { createRouter, createWebHistory } from 'vue-router';

import Home from '@/Pages/Home.vue';

import MoviesIndex from "@/Pages/Movies/MoviesIndex.vue";
import MoviesCreate from "@/Pages/Movies/MoviesCreate.vue";
import MoviesShow from "@/Pages/Movies/MoviesShow.vue";
import MoviesEdit from "@/Pages/Movies/MoviesEdit.vue";

import ScreeningsIndex from "@/Pages/Screenings/ScreeningsIndex.vue";
import ScreeningsCreate from "@/Pages/Screenings/ScreeningsCreate.vue";
import ScreeningsShow from "@/Pages/Screenings/ScreeningsShow.vue";
import ScreeningsEdit from "@/Pages/Screenings/ScreeningsEdit.vue";

import ScheduleIndex from "@/Pages/Schedule/ScheduleIndex.vue";

const routes = [
    // Home
    { path: '/', name: 'home', component: Home },

    // Movies
    { path: '/movies', name: 'movies.index', component: MoviesIndex },
    { path: '/movies/create', name: 'movies.create', component: MoviesCreate },
    { path: '/movies/:id', name: 'movies.show', component: MoviesShow, props: true },
    { path: '/movies/edit/:id', name: 'movies.edit', component: MoviesEdit, props: true  },

    // Screenings
    { path: '/screenings', name: 'screenings.index', component: ScreeningsIndex },
    { path: '/screenings/create', name: 'screenings.create', component: ScreeningsCreate },
    { path: '/screenings/:id', name: 'screenings.show', component: ScreeningsShow, props: true  },
    { path: '/screenings/edit/:id', name: 'screenings.edit', component: ScreeningsEdit, props: true  },

    // Schedule
    { path: '/schedule', name: 'schedule.index', component: ScheduleIndex },

    // API Documentation
    { path: '/docs/api', component: Home, beforeEnter() { window.location.href = '/docs/api'; } },
];

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes,
});

export default router;
