const mix = require('laravel-mix');

mix.browserSync({
    proxy: 'localhost:8000',
    files: 'public/*.*',
    notify: false
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version();
