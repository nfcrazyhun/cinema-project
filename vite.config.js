import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { watch } from "vite-plugin-watch";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        watch({
            pattern: "app/Enums/**/*.php",
            command: "php artisan publish:enums-to-javascript",
        }),
    ],
    build: {
        minify: true,
        sourcemap: false,
        rollupOptions: {
            output: {
                manualChunks: (path) => {
                    if (path.includes('node_modules')) {
                        return 'vendor';
                    } // else, continue with (default) dynamic chunking
                },
            },
        },
    },
    resolve: {
        alias: {
            "@": "/resources/js"
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler',
            },
        },
    },
});
