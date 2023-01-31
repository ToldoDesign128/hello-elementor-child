// webpack.mix.js

let mix = require("laravel-mix");
let minifier = require("minifier");

mix.sass("assets/scss/style.scss", "style.css").options({
  watchOptions: {
    ignored: /node_modules/,
  },
});
mix.sass("assets/scss/hamburgers.scss", "hamburgers.css").options({
  watchOptions: {
    ignored: /node_modules/,
  },
});
mix.then(() => {
  minifier.minify("style.css"), minifier.minify("hamburgers.css");
});

if (process.env.MIX_NOTIFICATIONS == "false") {
  mix.disableNotifications();
}
