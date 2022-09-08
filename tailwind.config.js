/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",
	],
	safelist: [
		{
			pattern: /text-(teal|purple|sky|yellow)-700/,
		},
		{
			pattern: /bg-(teal|purple|sky|yellow)-(50|600|700)/,
			variants: ['hover'],
		}
	],
	theme: {
		extend: {
			colors: {
				'primary': {
					25: '#fcfaff',
					50: '#f9f5ff',
					100: '#f4ebff',
					200: '#e9d7fe',
					300: '#d6bbfb',
					400: '#b692f6',
					500: '#9e77ed',
					600: '#7f56d9',
					700: '#6941c6',
					800: '#53389e',
					900: '#42307d',
				}
			}
		},
	},
	plugins: [
		require('@tailwindcss/typography'),
		require('@tailwindcss/forms'),
		require('@tailwindcss/aspect-ratio'),
	],
}
