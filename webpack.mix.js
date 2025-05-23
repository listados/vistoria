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

mix.js('resources/assets/js/app.js', 'public/js');

mix.styles([
    'resources/assets/css/survey.css'
], 'public/css/survey.css');

mix.styles([
    'resources/assets/css/all.css'
], 'public/css/all.min.css');

mix.js('resources/assets/js/survey.js',	'public/js');

 mix.js([
	'resources/assets/js/all.js'],
	'public/js/all.js').extract(['vue']);

//TEAM
mix.scripts([
    'resources/assets/js/teamSite.js'
], 'public/js/teamSite.js');

//DELIVERY
//  mix.js([
// 	'resources/assets/js/delivery.js'],
// 	'public/js/delivery.js');

//IMOVEL
//  mix.js([
// 	'resources/assets/js/immobile.js'],
// 	'public/js/immobile.js');

//CHAVES
//   mix.js([
// 	'resources/assets/js/key.js'],
// 	'js/key.js');

/* - PARA TODO O ESCOLHA AZUL - */
//PROPOSTA PF
  mix.js([
	'resources/assets/js/proposal_pf.js'],
	'public/js/proposal_pf.js');  

//ARQUIVOS PARA PROPOSTAS
  mix.js([
	'resources/assets/js/files.js'],
	'public/js/files.js');  


//PLUGINS
mix.copy([
	'node_modules/pnotify/dist/pnotify.js.map',
	'node_modules/pnotify/dist/pnotify.buttons.js',
	'node_modules/pnotify/dist/pnotify.js'
], 'public/js/plugins.js');

mix.styles([
    'node_modules/pnotify/dist/pnotify.buttons.css'
], 'public/css/pnotify.buttons.css');