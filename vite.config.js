import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resources/js/task.js', 'resources/js/user.js', 'resources/js/teams.js', 'resources/css/login.css', 'resources/js/project.js'],
            refresh: true,
        }),
    ],
});
