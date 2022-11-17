// webpack.mix.js

let mix = require('laravel-mix');
let minifier = require('minifier');

mix
    .sass('assets/scss/style.scss', 'style.css')
    .options({
        watchOptions: {
            ignored: /node_modules/
        }
    });
mix.then(() => {
    minifier.minify('style.css')
});

if (process.env.MIX_NOTIFICATIONS == 'false') {
    mix.disableNotifications();
}