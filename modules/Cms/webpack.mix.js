const mix = require('laravel-mix');
const env = process.env.NODE_ENV;

/*
 |--------------------------------------------------------------------------
 | Assets
 |--------------------------------------------------------------------------
 */

mix.sass(__dirname + '/resources/assets/sass/page-builder/layout.scss', 'public/modules/cms/css/page-builder')
	.sass(__dirname + '/resources/assets/sass/page-builder/canvas.scss', 'public/modules/cms/css/page-builder')
	.sass(__dirname + '/resources/assets/sass/cms.scss', 'public/modules/cms/css');
mix.js(__dirname + '/resources/assets/js/page-builder/init/full.js', 'public/modules/cms/js/page-builder/init')
	.js(__dirname + '/resources/assets/js/page-builder/init/light.js', 'public/modules/cms/js/page-builder/init');

/*
 |--------------------------------------------------------------------------
 | Options
 |--------------------------------------------------------------------------
 */

// mix.version()
// 	.sourceMaps()
// 	.options({
// 		postCss: [
// 			require('autoprefixer')(),
// 			require('postcss-css-variables')()
// 		],
// 		// processCssUrls: false
// 	})
// 	.disableNotifications();
