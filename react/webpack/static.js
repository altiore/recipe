const webpack = require('webpack')
const { resolve } = require('path')
const webpackMerge = require('webpack-merge')
const ExtractTextPlugin = require("extract-text-webpack-plugin")
const InterpolateHtmlPlugin = require('react-dev-utils/InterpolateHtmlPlugin')
const StaticSiteGeneratorPlugin = require('static-site-generator-webpack-plugin')

const commonConfig = require(resolve(__dirname, 'base'))
let routes = require(resolve(__dirname, '../app/pages/routes.json'))
require('dotenv').config()

const outputFolder = process.env.OUTPUT_FOLDER || resolve(__dirname, '..', 'dist')

console.log(routes)

module.exports = env => webpackMerge(commonConfig, {
  entry: {
    index: [
      './static.js',
    ],
  },
  output: {
    path: outputFolder,
    filename: 'trash/js/[name].[hash:8].js',
    libraryTarget: 'umd',
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        loader: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            'css-loader',
            'resolve-url-loader',
            'postcss-loader',
          ],
        }),
      },
      {
        test: /\.scss$/,
        loader: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            'css-loader',
            'resolve-url-loader',
            'postcss-loader',
            {
              loader: 'sass-loader',
              query: {
                sourceMap: true,
              },
            },
          ],
        }),
      },
      {
        test: /\.css2$/,
        loader: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            {
              loader: 'css-loader',
              options: {
                modules: true,
                importLoaders: 1,
                localIdentName: '[hash:base64:5]',
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
        }),
      },
      {
        test: /\.scss2$/,
        loader: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            {
              loader: 'css-loader',
              options: {
                modules: true,
                importLoaders: 1,
                localIdentName: '[hash:base64:5]',
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
        }),
      },
      {
        test: /\.html$/,
        use: [ {
          loader: 'html-loader',
          options: {
            minimize: true,
          },
        }],
      },
    ],
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: JSON.stringify('production')
      },
    }),
    new InterpolateHtmlPlugin({
      'NODE_ENV': process.env.NODE_ENV || 'development',
      'PUBLIC_URL': '/',
    }),
    new ExtractTextPlugin({
      filename: 'trash/css/[name].[contenthash].css',
    }),
    new StaticSiteGeneratorPlugin({
      paths: routes.map(route => route.path),
      locals: {
        // Properties here are merged into `locals`
        // passed to the exported render function
      },
      globals: {
        window: {},
        localStorage: {
          getItem: key => null,
          setItem: (key, value) => {},
          removeItem: key => {},
          clear: () => {},
        },
      },
    }),
  ],
})
