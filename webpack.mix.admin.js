const mix = require('laravel-mix');
let distPath = 'public/assets/admin';
const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');
const path = require('path')
function resolve(dir) {
    return path.join(
        __dirname,
        '/resources/admin/js',
        dir
    );
}
mix
    .js('resources/admin/js/app.js', 'js')
    .extract([
        'vue',
        'axios',
        'vuex',
        'vue-router',
        'vue-i18n',
        'element-ui',
    ])
    .vue({ version: 2 })
    .sass('resources/admin/scss/app.scss', 'css')
    .sass('resources/admin/scss/components/tinymce/tinymce.scss', 'css')
    .options({
        processCssUrls: false,
        processJsUrls:false
    })

    .webpackConfig({

        resolve: {
            extensions: ['.js', '.vue', '.json','.scss','.css'],
            alias: {
                '@': path.join(__dirname, 'resources')
            },
            fallback: {"path":false}
        },
        output: {
            filename: '[name].js',
            chunkFilename: 'js/[name].[chunkhash:6].js',
            publicPath: '/assets/admin/',

        },
    })
    .sourceMaps()
    .setPublicPath(distPath)
    .setResourceRoot("/assets/site/")
    .version();
