import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    /* server: {
        watch: {
            usePolling: true
        }
    }, */
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                }
            },
        }),
    ],
    test: {
        globals: true,
        // setupFiles: 'resources/js/Tests/SetupTests.js',
        includeSource: ["src/**/*.{js,ts,vue}"],
        environment: 'happy-dom'
    },
});
