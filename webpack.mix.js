const mix = require('laravel-mix');
const env = process.env.NODE_ENV;

require(__dirname + '/modules/Cms/webpack.mix.js');

/*
 |--------------------------------------------------------------------------
 | Assets
 |--------------------------------------------------------------------------
 */

// === Front ===
mix.sass('resources/assets/sass/front/vendor.scss', 'public/css/front')
	.sass('resources/assets/sass/front/app.scss', 'public/css/front')
	.sass('resources/assets/sass/auth.scss', 'public/css')
	.sass('resources/assets/sass/front/resources.scss', 'public/css')
	.js('resources/assets/js/front/app.js', 'public/js/front')
;

// === Back ===
mix.sass('resources/assets/sass/back/vendor.scss', 'public/css/back')
	.sass('resources/assets/sass/back/app.scss', 'public/css/back')
	.sass('resources/assets/sass/back/statistics.scss', 'public/css/back')
	.js('resources/assets/js/back/app.js', 'public/js/back')
;

// === TinyMCE Packages ===
mix.copyDirectory('node_modules/tinymce/icons', 'public/node_modules/tinymce/icons');
mix.copyDirectory('node_modules/tinymce/plugins', 'public/node_modules/tinymce/plugins');
mix.copyDirectory('node_modules/tinymce/skins', 'public/node_modules/tinymce/skins');
mix.copyDirectory('resources/assets/tinymce/langs', 'public/node_modules/tinymce/langs');
mix.copyDirectory('node_modules/tinymce/themes', 'public/node_modules/tinymce/themes');
mix.copy('node_modules/tinymce/jquery.tinymce.js', 'public/node_modules/tinymce/jquery.tinymce.js');
mix.copy('node_modules/tinymce/jquery.tinymce.min.js', 'public/node_modules/tinymce/jquery.tinymce.min.js');
mix.copy('node_modules/tinymce/tinymce.js', 'public/node_modules/tinymce/tinymce.js');
mix.copy('node_modules/tinymce/tinymce.min.js', 'public/node_modules/tinymce/tinymce.min.js');

/*
 |--------------------------------------------------------------------------
 | Options
 |--------------------------------------------------------------------------
 */

mix.version()
	.sourceMaps()
	.options({
		postCss: [
			require('autoprefixer')(),
			require('postcss-css-variables')()
		],
		// processCssUrls: false
	})
	.disableNotifications()
	.webpackConfig({
		resolve: {
			alias: {
				'jquery-ui/sortable': 'jquery-ui/ui/widgets/sortable.js',
			},
		}
	});


