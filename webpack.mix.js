const mix = require('laravel-mix');

mix.setPublicPath('./');

mix.postCss('./source/css/mu-cos-courses.css', 'css/mu-cos-courses.css', [
    require('postcss-import'),
    require('postcss-nesting'),
    require('tailwindcss'),
		require('autoprefixer')
  ]
);

if (mix.inProduction()) {
    mix.version();
}
