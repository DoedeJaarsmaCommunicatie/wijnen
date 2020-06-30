const mix = require('laravel-mix');

mix
    .js('assets/scripts/main.js', 'dist/scripts/main.js')
    .copyDirectory('assets/vendor', 'dist/vendor')
    .extract()
    .webpackConfig({
        output: {
            chunkFilename: '[name].js?id=[chunkhash]',
        },
        resolve: {
            alias: {
                react: 'preact/compat',
                'react-dom': 'preact/compat'
            }
        }
    })
    .disableNotifications();
