import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/dashboard.css',
                'resources/js/app.js',
                'resources/js/dashboard.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        hmr: {
            host: '127.0.0.1',
            port: 5173,
        },
        port: 5173,
        host: '127.0.0.1',
        strictPort: false,
        watch: {
            usePolling: true,
            interval: 1000
        }
    },
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
});
