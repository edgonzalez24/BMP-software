const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./vendor/laravel/jetstream/**/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./resources/js/**/*.vue',
	],

	theme: {
		extend: {
			fontFamily: {
				sans: ['Nunito', ...defaultTheme.fontFamily.sans],
				roboto: ['Roboto'],
				poppins: ['Poppins'],

			},
			colors: {
				'dark-blue': {
					500: '#404E67'
				},
				blue: {
					500: '#3472D8',
					600: '#072C8A',
				},
				gray: {
					50: 'rgba(167, 165, 165, 0.27)',
					100: '#F3F4F6',
					200: '#F9FBFD'
				}
			},
			boxShadow: {
				card: '0 4px 6px -1px rgb(0 0 0 / 0.25), 0 2px 4px -2px rgb(0 0 0 / 0.25)'
			},
			minHeight: {
				'list': '50px',
				'base': '500px',
				'table': '200px',
				'lg': '700px',
				'xl': '900px',
			},
		},
	},

	plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
