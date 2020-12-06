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
	.js('resources/assets/js/front/app.js', 'public/js/front')
;

// === Back ===
mix.sass('resources/assets/sass/back/vendor.scss', 'public/css/back')
	.sass('resources/assets/sass/back/app.scss', 'public/css/back')
	.js('resources/assets/js/back/app.js', 'public/js/back')
;

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
