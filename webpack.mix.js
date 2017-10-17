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

mix.browserSync('devclub.dev');
mix.disableNotifications();
mix.js('resources/assets/js/app.js', 'public/js')
	.scripts(['resources/assets/vendor/map/map-style.js', 'resources/assets/vendor/jsvalidation/js/jsvalidation.js', 'resources/assets/js/home.js'], 'public/js/home.js')
	.scripts(['resources/assets/vendor/map/map-style.js', 'resources/assets/vendor/jsvalidation/js/jsvalidation.js', 'resources/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js', 'resources/assets/js/register.js'], 'public/js/register.js')
	.styles('resources/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css', 'public/css/register.css')
   	.sass('resources/assets/sass/app.scss', 'public/css');
