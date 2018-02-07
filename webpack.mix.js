let mix = require('laravel-mix');

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

mix
    .options({
        processCssUrls: false
    })
    .copy('node_modules/font-awesome/fonts/FontAwesome.otf', 'resources/dist/fonts/FontAwesome.otf')
    .copy('node_modules/font-awesome/fonts/fontawesome-webfont.eot', 'resources/dist/fonts/fontawesome-webfont.eot')
    .copy('node_modules/font-awesome/fonts/fontawesome-webfont.svg', 'resources/dist/fonts/fontawesome-webfont.svg')
    .copy('node_modules/font-awesome/fonts/fontawesome-webfont.ttf', 'resources/dist/fonts/fontawesome-webfont.ttf')
    .copy('node_modules/font-awesome/fonts/fontawesome-webfont.woff', 'resources/dist/fonts/fontawesome-webfont.woff')
    .copy('node_modules/font-awesome/fonts/fontawesome-webfont.woff2', 'resources/dist/fonts/fontawesome-webfont.woff2')
    .copyDirectory('resources/assets/favicons', 'resources/dist/favicons')
    .js('resources/assets/js/backend.js', 'js')
    .sass('resources/assets/sass/backend.scss', 'css')
    .sourceMaps()
    .setPublicPath('resources/dist')
;

mix.browserSync({
    files: ['public/**/*', 'public/*', 'resources/*', 'resources/**/*'],
    proxy: 'dev.cms'
});
