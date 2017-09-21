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
	.scripts('resources/assets/js/home.js', 'public/js/home.js')
	.scripts('resources/assets/js/register.js', 'public/js/register.js')
	.scripts('resources/assets/js/map-style.js', 'public/js/map-style.js')
   	.sass('resources/assets/sass/app.scss', 'public/css');
