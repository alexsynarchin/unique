const path = require('path');

function resolve(dir) {
  return path.join(
    __dirname,
    '/resources/admin/js',
    dir
  );
}

module.exports = {
  resolve: {
      extensions: ['.js', '.vue', '.json'],
      alias: {
          '@': path.join(__dirname, 'resources')
      },
      fallback: {"path":false}
  },
  module: {
    rules: [
      {
        test: /\.svg$/,
        loader: 'svg-sprite-loader',
        include: [resolve('icons/svg')],
        options: {
          symbolId: 'icon-[name]',
        },
      },
    ],
  },
    output: {
        filename: '[name].js',
        chunkFilename: 'js/[name].[chunkhash:6].js',
        publicPath: '/assets/admin/',

    },
};
