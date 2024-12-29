const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

// Basic asset compilation
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sourceMaps();

// BrowserSync configuration for live-reloading
mix.browserSync({
    proxy: 'http://127.0.0.1:8000/', // Replace with your local development URL
    open: false, // Don't open the browser automatically
    notify: false, // Disable BrowserSync notifications
    injectChanges: true, // Inject the changes into the browser automatically
    files: [
        'app/**/*.php',
        'resources/views/**/*.php',
        'resources/js/**/*.js',
        'resources/sass/**/*.scss'
    ],
});
