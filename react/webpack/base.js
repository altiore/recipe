const { resolve } = require('path')
const webpack = require('webpack')
const Package = require(resolve(__dirname, '..', 'package'))
const Dotenv = require('dotenv-webpack')
require('dotenv').config()

const appDir = process.env.APP_DIR || resolve(__dirname, '..', 'app')
const staticFolder = process.env.STATIC_FOLDER || resolve(__dirname, '..', 'static')
const outputFolder = process.env.OUTPUT_FOLDER || resolve(__dirname, '..', 'dist')

module.exports = {
  name: Package.name,
  context: resolve(__dirname, '..', 'app'),
  target: 'web',
  output: {
    path: outputFolder,
    filename: 'static/js/[name].js',
    chunkFilename: 'static/js/[name].[hash:8].chunk.js',
    publicPath: '/',
    pathinfo: true,
  },
  resolve: {
    extensions: ['.js', '.json', '.md'],
    alias: {
      root: resolve(__dirname, '..'),
      domains: resolve(__dirname, '..', 'app', 'domains'),
      containers: resolve(__dirname, '..', 'app', 'containers'),
      components: resolve(appDir, 'components'),
      styles: resolve(appDir, 'styles'),
      store: resolve(appDir, 'store'),
      helpers: resolve(appDir, 'helpers'),
      static: staticFolder,
      data: resolve(appDir, 'data'),
    },
    modules: [
      'node_modules',
    ],
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)?$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
      },
      {
        test: /\.md$/,
        use: [
          {
            loader: "html-loader",
          },
        ],
      },
      {
        test: /\.(jpe?g|png|gif|svg)$/i,
        use: [
          {
            loader: 'file-loader',
            options: {
              digest: 'hex',
              name: 'static/media/[name].[hash:8].[ext]',
            },
          },
        ],
      },
      {
        test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        loader: 'file-loader',
        options: {
          limit: 10000,
          minetype: 'application/font-woff',
          name: 'static/fonts/[name].[hash:8].[ext]',
        },
      },
      {
        test: /\.(ttf|eot)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        loader: 'file-loader',
        options: {
          name: 'static/fonts/[name].[hash:8].[ext]',
        },
      },
    ],
  },
  plugins: [
    new Dotenv({
      path: './.env', // Path to .env file (this is the default)
      safe: true, // load .env.example (defaults to "false" which does not use dotenv-safe)
    }),
  ],
  node: {
    fs: 'empty',
    net: 'empty',
    tls: 'empty',
  },
}
