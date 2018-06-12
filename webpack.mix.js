let mix = require('laravel-mix')
let tailwindcss = require('tailwindcss')
require('laravel-mix-purgecss')

mix.js('resources/assets/js/app.js', 'public/js')
    .copyDirectory('resources/assets/img', 'public/img')
    .sass('resources/assets/scss/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.js')]
    })
    .purgeCss()

if (mix.inProduction()) {
    mix.version()
}
