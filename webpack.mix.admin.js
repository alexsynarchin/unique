const mix = require('laravel-mix');
let distPath = 'public/assets/admin';
const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');
const path = require('path')
function resolve(dir) {
    return path.join(
        __dirname,
        '/resources',
        dir
    );
}
mix
    .js('resources/admin/js/app.js', 'js')
    .vue({ version: 2 })
    .sass('resources/admin/scss/app.scss', 'css')
    .options({
        processCssUrls: false,
        processJsUrls:false
    })

    .webpackConfig({
        plugins: [
            new SVGSpritemapPlugin('resources/admin/svg/*.svg',{
                output:{
                    filename:'images/sprites.svg'
                }
            }),
        ],
        resolve: {
            extensions: ['.js', '.vue', '.json','.scss','.css'],
            alias: {
                '@': path.join(__dirname, 'resources')
            },
            fallback: {"path":false}
        },
    })
    .sourceMaps()
    .setPublicPath(distPath)
    .setResourceRoot("/assets/site/")
    .version();
