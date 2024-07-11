module.exports = {
  presets: [
    require('@marshallu/marsha-tailwind')
  ],
	darkMode: 'class',
	content: require('fast-glob').sync([
		'./*.php',
		'./**/*.php',
	]),
}
