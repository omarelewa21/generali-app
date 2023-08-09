import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/jquery.min.js', 'resources/css/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),       
],
});


