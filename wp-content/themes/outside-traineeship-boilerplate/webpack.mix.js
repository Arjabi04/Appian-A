const fs = require('fs');
const path = require('path');
const mix = require('laravel-mix');

const styleFiles = fs.readdirSync(path.resolve(__dirname, 'resources', 'styles', 'styles'), 'utf-8');
const scriptFiles = fs.readdirSync(path.resolve(__dirname, 'resources', 'scripts', 'modules'), 'utf-8');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Sage application. By default, we are compiling the Sass file
 | for your application, as well as bundling up your JS files.
 |
 */

mix
  .setPublicPath('./public')
  .browserSync('wordpress-boilerplate-trainee.local');

for (let style of styleFiles) {
  mix.sass(`resources/styles/styles/${style}`, 'styles/modules');
}

mix
  .sass('resources/styles/app.scss', 'styles')
  .sass('resources/styles/editor.scss', 'styles')
  .webpackConfig({
    devtool: 'source-map'
  });

for (let script of scriptFiles) {
  mix.js(`resources/scripts/modules/${script}`, 'scripts')
    .autoload({ jquery: ['$', 'window.jQuery'] })
    .extract();
}

mix
  .js('resources/scripts/app.js', 'scripts')
  .autoload({ jquery: ['$', 'window.jQuery'] })
  .extract();

mix
  .copyDirectory('resources/images', 'public/images')
  .copyDirectory('resources/fonts', 'public/fonts');

mix
  .sourceMaps()
  .version();
