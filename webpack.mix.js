const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.sourceMaps();
mix.js('resources/js/app.js', 'public/js');
//mix.copy('node_modules/@fortawesome/fontawesome-pro/css', 'public/css/fontawesome/css');
//mix.copy('node_modules/@fortawesome/fontawesome-pro/webfonts', 'public/css/fontawesome/webfonts');
mix.copy('node_modules/@fullcalendar/common/main.css', 'public/css/fullcalendar.css');
mix.copy('node_modules/mdb-ui-kit/js/mdb.min.js', 'public/js/mdb.min.js');
mix.copy('node_modules/quill/dist/quill.snow.css', 'public/css/quill.snow.css');
mix.copy('node_modules/quill/dist/quill.core.css', 'public/css/quill.core.css');
mix.copy('resources/assets', 'public/assets');
mix.copy('resources/assets/favicon.ico', 'public/favicon.ico');
mix.sass('resources/sass/main.scss', 'public/css/acolyte.css');
