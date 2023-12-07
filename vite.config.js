import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/livewire_events.js',
                'resources/js/loading.js',
                'resources/js/facturacion.js'
                ],
            refresh: true,
        }),
    ],
});
