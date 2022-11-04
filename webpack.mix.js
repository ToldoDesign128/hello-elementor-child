// webpack.mix.js

let mix = require('laravel-mix');

mix
    .sass('assets/scss/style.scss', 'style.css')
    .options({
        watchOptions: {
            ignored: /node_modules/
        }
    });

if (process.env.MIX_NOTIFICATIONS == 'false') {
    mix.disableNotifications();
}