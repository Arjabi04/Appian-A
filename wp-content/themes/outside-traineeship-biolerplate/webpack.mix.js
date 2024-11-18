const mix = require('laravel-mix');

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
