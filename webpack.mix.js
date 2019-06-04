const mix = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            '@': __dirname + '/resources'
        },
    },
});

mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .sass('resources/sass/app.scss', 'public/css');
