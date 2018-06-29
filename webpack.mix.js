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
    .browserSync({ proxy: '127.0.0.1:8000', snippetOptions: {
      rule: {
        match: /<\/head>/i,
        fn: function (snippet, match) {
          return snippet + match;
        }
      }
    }, })

if (mix.inProduction()) {
    mix
        .version()
        .purgeCss()
}
