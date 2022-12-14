/** @type {import('tailwindcss').Config} */
// const colors = require('tailwindcss/colors')
module.exports = {
	content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./resources/**/*.blade.php',
		'./resources/js/*.js',
		'./resources/**/*.vue',
		//'./node_modules/tw-elements/dist/js/**/*.js',
		'./node_modules/flowbite/**/*.js',
	],
	safelist: [
		'w-[90px]',
		'h-[90px]',
		'w-[80px]',
		'h-[142px]',
		{
			pattern: /(bg|text|border|ring)-interface-color(1|2|3|4|5|6)/,
			variants: [
				'sm', 'md', 'lg', 'xl', '2xl',
				'sm:hover', 'md:hover', 'lg:hover', 'xl:hover', '2xl:hover',
				'sm:active', 'md:active', 'lg:active', 'xl:active', '2xl:active',
				'sm:focus', 'md:focus', 'lg:focus', 'xl:focus', '2xl:focus',
				'hover', 'active', 'focus',
				'peer-checked'
			],
		},
		{
			pattern: /(bg|text|border|ring)-status-(bluegreen|purple|yellow|red|green)/,
			variants: [
				'sm', 'md', 'lg', 'xl', '2xl',
				'sm:hover', 'md:hover', 'lg:hover', 'xl:hover', '2xl:hover',
				'sm:active', 'md:active', 'lg:active', 'xl:active', '2xl:active',
				'sm:focus', 'md:focus', 'lg:focus', 'xl:focus', '2xl:focus',
				'hover', 'active', 'focus',
				'peer-checked'
			],
		},
	],
	darkMode: 'class', // or 'media' or 'class'
	plugins: [
		//require('tw-elements/dist/plugin'),
		require('@tailwindcss/forms'),
		require('@tailwindcss/typography'),
		require('flowbite/plugin'),
	],
	theme: {
		fontFamily: {
			'sans': ['Plus Jakarta Sans', 'sans-serif'],
			'serif': [],
			'mono': [],
			//'display':  [],
			//'body':     [],
		},
		// default tailwindcss colors
		// colors: {
		//     transparent: 'transparent',
		//     current: 'currentColor',
		//     black: colors.black,
		//     white: colors.white,
		//     gray: colors.gray,
		//     emerald: colors.emerald,
		//     indigo: colors.indigo,
		//     yellow: colors.yellow,
		// },
		extend: {
			colors: {
				pink: '#FF9595',
				light: '#F8F9FA',
				dark: '#181A1E',
				customblack: {
					black: '#202528',
					lightblack: '#333A3F',
				},
				darkblue: '#344767',
				dirtywhite: '#F2F2F2',
				customgray: {
					gray: '#67748E',
					grayishblue: '#A3BDCC',
					darkgray: '#5F6368',
					lightgray: '#A8AAAD'
				},
				status: {
					bluegreen: '#5AC5AD',
					purple: '#6D3795',
					yellow: '#FFD272',
					red: '#F03023',
					green: '#4BAF61'
				},
				customtheme: {
					blue: '#189EDD',
					green: '#4BAF61',
					yellow: '#FFD272',
					bluegreen: '#5AC5AD',
					darkblue: '#1A2B88',
				},
				interface: {
					color1: '#FF9595',
					color2: '#85b8ef',
					color3: '#33cc9b',
					color4: '#ee2711',
					color5: '#6c40bf',
					color6: '#1A2B88',
				}
			}
		},
		// text-pinkcumstom
		// text-maincolor-light,
	}

	// pinkAccent: '#FF9595',
	// mainColor: {
	//     light: '#F8F9FA',
	//     dark: '#181A1E'
	// },

	// //used for card backgrounds on dark mode (bg-white is the opposite)
	// card: {
	//     dark: '#202528'
	// },

	// //used mostly on text
	// darkBlue: {
	//     light: '#344767',
	//     dark: '#F2F2F2'
	// },
	// gray: {
	//     light: '#67748E',
	//     dark: '#A3BDCC',

	//     //the darker version of gray
	//     darker: {
	//         light: '#5F6368'
	//         // dark: ''
	//     },

	//     //the lighter version of gray
	//     lighter: {
	//         light: '#A8AAAD',
	//         // dark: '#A3BDCC'
	//     },

	//     //used on backgrounds for textbox and dark switch
	//     bg: {
	//         // light: '#F2F2F2',
	//         dark: '#333A3F'
	//     }
	// },
}
