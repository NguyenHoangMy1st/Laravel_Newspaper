const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/assets/sass/pages/home/home.scss', 'public/css');
mix.sass('resources/assets/sass/pages/global/global.scss', 'public/css');
mix.sass('resources/assets/sass/pages/story_detail/story_detail.scss', 'public/css');
mix.sass('resources/assets/sass/pages/blog/blog.scss', 'public/css');
mix.sass('resources/assets/sass/pages/blog_detail/blog_detail.scss', 'public/css');


mix.js('resources/assets/js/pages/home.js', 'public/js');
mix.js('resources/assets/js/pages/blog.js', 'public/js');
mix.js('resources/assets/js/pages/global.js', 'public/js');
mix.js('resources/assets/js/pages/story.js', 'public/js');

mix.options({
    processCssUrls: false
})
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
    });
