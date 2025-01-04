import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/sb-admin-2.min.css',
                'resources/css/app.css',
                'resources/js/sb-admin-2.min.js',
                'resources/js/demo/chart-bar-demo.js',
                'resources/js/demo/chart-pie-demo.js',
                'resources/js/demo/chart-area-demo.js',
                'resources/js/demo/datatables-demo.js',
                'resources/js/api.js',
                'resources/js/app.js',
                'resources/js/bootstrap.js',],
            refresh: true,
        }),
    ],
});
