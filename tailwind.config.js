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
		extend: {},
	},
	plugins: [
		require('@tailwindcss/typography'),
		require('@tailwindcss/forms'),
		require('@tailwindcss/aspect-ratio'),
	],
}
