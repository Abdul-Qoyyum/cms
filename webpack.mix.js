let mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/src/js')
    .postCss('resources/css/app.css', 'public/src/css');
