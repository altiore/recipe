const { resolve } = require('path');
const webpack = require('webpack');
const webpackMerge = require('webpack-merge');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const Package = require('../package');
const commonConfig = require('./base');

module.exports = webpackMerge(commonConfig, {
  plugins: [
    new webpack.LoaderOptionsPlugin({
      minimize: false,
      debug: true,
    }),
    new HtmlWebpackPlugin({
      title: Package.title,
      cache: true,
      showErrors: true,
      template: resolve(__dirname, '..', 'static', 'index.html'),
    }),
    new webpack.HotModuleReplacementPlugin(),
    new webpack.NoEmitOnErrorsPlugin(),
    new webpack.NamedModulesPlugin(),
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: JSON.stringify('development'),
      },
    }),
  ],
  devtool: 'inline-source-map',
  entry: {
    index: [
      'webpack-hot-middleware/client',
      'webpack/hot/only-dev-server',
      'react-hot-loader/patch',
      'babel-polyfill',
      './dev.js',
    ],
  },
  module: {
    rules: [
      {
        enforce: 'pre',
        test: /\.(js|jsx)$/,
        loader: 'eslint-loader',
        include: resolve(__dirname, '..', 'app'),
        exclude: resolve(__dirname, '../app/components/molecules/Timer'),
      },
      {
        test: /\.scss$/,
        use: [
          "style-loader",
          "css-loader",
          "resolve-url-loader",
          {
            loader: 'postcss-loader',
            options: {
              config: resolve(__dirname, '..', 'postcss.config.js'),
            },
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true,
            },
          },
        ],
      },
      {
        test: /\.css$/,
        use: [
          "style-loader",
          "css-loader",
          "resolve-url-loader",
          {
            loader: 'postcss-loader',
            options: {
              config: resolve(__dirname, '..', 'postcss.config.js'),
            },
          },
        ],
      },
      {
        test: /\.css2$/,
        use: [
          'style-loader',
          {
            loader: 'css-loader',
            options: {
              modules: true,
              importLoaders: 1,
              localIdentName: '[local]__[hash:base64:5]',
            },
          },
          'resolve-url-loader',
          {
            loader: 'postcss-loader',
            options: {
              config: resolve(__dirname, '..', 'postcss.config.js'),
            },
          },
        ],
      },
      {
        test: /\.scss2$/,
        use: [
          'style-loader',
          {
            loader: 'css-loader',
            options: {
              modules: true,
              importLoaders: 1,
              localIdentName: '[local]__[hash:base64:5]',
            },
          },
          'resolve-url-loader',
          {
            loader: 'postcss-loader',
            options: {
              config: resolve(__dirname, '..', 'postcss.config.js'),
            },
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true,
            },
          },
        ],
      },
    ],
  },
})
