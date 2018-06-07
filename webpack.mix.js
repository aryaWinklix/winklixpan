let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.browserSync('http://localhost/pantry/public/home');

mix.sass('resources/assets/sass/front/app.scss', 'public/css/front')
   .sass('resources/assets/sass/admin/admin.scss', 'public/css/admin');
