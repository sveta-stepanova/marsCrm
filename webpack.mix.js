const mix = require('laravel-mix'),
	path = require('path');

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


/*
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
*/


mix.webpackConfig({
	module: {
		rules: [
			{
				test: /\.js$/,
				loader: 'imports-loader?jQuery=jquery,$=jquery,this=>window',
			}, {
				test: /\.js$/,
				use: { loader: 'babel-loader', options: { presets: ['es2015'] } }
			}
		]
	},
	resolve: {
		modules: [
			path.resolve('./resources/js-lib'),
			path.resolve('./node_modules/'),
			path.resolve('./resources/css/'),
		]
	},
});


mix.js('resources/js/app.js', 'public/js')
	.js('resources/js/breeder-edit/breeder-edit.js', 'public/js')
        .js('resources/js/perfectfit/breeder-edit.js', 'public/js/perfectfit')
	.styles(['resources/css/common.css','resources/css/edit-form.css'], 'public/css/app.css')
	.styles(['resources/css/breeder-edit/*.css'], 'public/css/breeder-edit.css')
        .styles(['resources/css/perfectfit/*.css'], 'public/css/perfectfit/style.css');

// mix.disableNotifications();

