const mix = require('laravel-mix');
require('laravel-mix-purgecss');

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

 mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.EnvironmentPlugin (
                ['MIX_STRIPE_KEY']
            )
        ]
    };
});

 // mix.js('resources/js/memorial-garden-form.js', 'public/js');

mix.js('resources/js/index.js', 'public/js')
   .js('resources/js/lottery.js', 'public/js')
   .js('resources/js/lottery-form.js', 'public/js')
   .js('resources/js/memorial-garden.js', 'public/js')
   .js('resources/js/memorial-garden-form.js', 'public/js')
   .js('resources/js/news.js', 'public/js')
   .js('resources/js/shop.js', 'public/js')
   .js('resources/js/contact.js', 'public/js')
   .sass('resources/sass/styles.scss', 'public/css')
   .purgeCss({
   		globs: [
            path.join(__dirname, "resources/views/**/*.blade.php"),
            path.join(__dirname, "resources/js/components/**/*.vue"),
            path.join(__dirname, "resources/assets/js/**/*.js")
        ],
        extensions: ['html', 'js', 'php', 'vue'],
        whitelistPatterns: [/carousel-.*/, /show/, /screw/, /metal/, /webp/, /no-webp/],
    });

mix.js('resources/js/admin.js', 'public/js')
   .sass('resources/sass/admin.scss', 'public/css');

mix.copy('resources/images/', 'public/images/', false);
