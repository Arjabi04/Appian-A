const fs = require('fs');
const path = require('path');
const mix = require('laravel-mix');

const styleFiles = fs.readdirSync(path.resolve(__dirname, 'resources', 'scss', 'modules'), 'utf-8');
const scriptFiles = fs.readdirSync(path.resolve(__dirname, 'resources', 'js', 'modules'), 'utf-8');

for (let style of styleFiles) {
  mix.sass(`resources/scss/modules/${style}`, 'assets/css/modules');
}

for (let script of scriptFiles) {
  mix.js(`resources/js/modules/${script}`, 'assets/js/modules')
    .autoload({ jquery: ['$', 'window.jQuery'] })
    .extract();
}

// Set the public path (your theme directory).
mix.setPublicPath('./');

// Compile JavaScript
mix.js('resources/js/app.js', 'assets/js')
   .sourceMaps();

// Compile SCSS
mix.sass('resources/scss/style.scss', 'assets/css')
   .options({
       processCssUrls: false,
   });

// Copy images
mix.copyDirectory('resources/images', 'assets/images');

// Enable versioning in production
if (mix.inProduction()) {
    mix.version();
}

// Enable browser-sync for development (optional)
mix.browserSync({
    proxy: 'wordpress-tainee-biolerplate.local', // Replace with your local dev URL
    files: [
        './*.php',
        'assets/css/**/*.css',
        'assets/js/**/*.js'
    ]
});
