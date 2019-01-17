let mix = require('laravel-mix');
let src_path = 'resources/assets/js/';

mix.webpackConfig({
  resolve: {
    alias: {
      '@src': path.resolve(__dirname, src_path),
      '@views': path.resolve(__dirname, src_path + 'views/'),
      '@components': path.resolve(__dirname, src_path + 'components/'),
    }
  }
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(['resources/assets/js/app.js', 'public/js/batinon.js'], 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')