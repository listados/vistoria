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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    'resources/assets/css/survey.css'
], 'public/css/survey.css');

mix.styles([
    'resources/assets/css/all.css'
], 'public/css/all.min.css');


 mix.js([
	'resources/assets/js/survey.js'],
	'public/js/survey.js').extract(['vue']);

//DELIVERY
 mix.js([
	'resources/assets/js/delivery.js'],
	'public/js/delivery.js');

//IMOVEL
 mix.js([
	'resources/assets/js/immobile.js'],
	'public/js/immobile.js');

//CHAVES
  mix.js([
	'resources/assets/js/key.js'],
	'js/key.js');

/* - PARA TODO O ESCOLHA AZUL - */
//PROPOSTA PF
  mix.js([
	'resources/assets/js/proposal_pf.js'],
	'public/js/proposal_pf.js');  
// mix.scripts([
//     'public/js/admin.js',
//     'public/js/dashboard.js'
// ], 'public/js/all.js');