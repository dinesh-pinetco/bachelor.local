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

mix.js('resources/js/app.js', 'public/js')
    .css('resources/css/nice-select.css', 'public/css')
    .copy([
        'resources/js/popper.min.js',
        'resources/js/tippy-bundle.umd.js'
    ], 'public/js')
    .copy([
        'node_modules/intl-tel-input/build/js/intlTelInput.min.js',
        'node_modules/intl-tel-input/build/js/utils.js',
        'node_modules/intl-tel-input/build/css/intlTelInput.min.css'
    ], 'public/plugins')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

if (mix.inProduction()) {
    mix.version();
}
