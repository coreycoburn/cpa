let mix = require("laravel-mix");
let tailwindcss = require("tailwindcss");
require("laravel-mix-purgecss");

mix.js("resources/js/app.js", "public/js")
    .copyDirectory("resources/img", "public/img")
    .sass("resources/scss/app.scss", "public/css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.js")]
    });
// .browserSync({ proxy: '127.0.0.1:8000', snippetOptions: {
//   rule: {
//     match: /<\/head>/i,
//     fn: function (snippet, match) {
//       return snippet + match;
//     }
//   }
// }, });

if (mix.inProduction()) {
    mix.version().purgeCss();
}
