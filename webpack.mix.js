
const postcssNesting = require('postcss-nesting');
const autoPrefixer = require('autoprefixer');
const tailwindcss = require('tailwindcss');
const mix = require('laravel-mix');
const path = require('path');

require('laravel-mix-eslint');

mix
	.eslint({
		fix: true,
		emitWarning: true,
		emitError: true,
		failOnWarning: true,
		failOnError: true,
		extensions: ['js'],

		overrideConfig: {
			parserOptions: {
				ecmaVersion: 'latest',
				sourceType: 'module',
			}
		}
		//...
	})
	.alias({ '@npm': path.join(__dirname, 'node_modules') })
	.js('resources/js/app.js', 'public/js')
	.js('resources/js/app.defer.js', 'public/js')
	.js('node_modules/flowbite/dist/flowbite.js', 'public/js')
	.js('node_modules/flowbite/dist/datepicker.js', 'public/js')
	.js('node_modules/@fortawesome/fontawesome-free/js/all.min.js', 'public/js');
mix
	.options({
		cssNano: { minifyFontValues: false },
		processCssUrls: true,
		postCss: [
			postcssNesting,
			autoPrefixer
		]
	})
	.postCss('resources/css/tailwind.css', 'public/css', [tailwindcss])
	.postCss('node_modules/flowbite/dist/flowbite.min.css', 'public/css')
	.postCss('resources/css/glightbox.min.css', 'public/css')
	.postCss('resources/css/plyr.min.css', 'public/css')
	.postCss('resources/css/pdf.css', 'public/css')
	.sass('resources/scss/app.scss', 'public/css');

mix
	.copy(['resources/assets/images'], 'public/assets')
	.copy(['resources/js/chatify'], 'public/js/chatify')
	.copy(['resources/css/chatify'], 'public/css/chatify');

if (mix.inProduction()) {
	mix
		.version()
		.sourceMaps();
} else {
	mix
		.browserSync('rectify.test')
		.dump();
}
