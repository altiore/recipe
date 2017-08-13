const webpack = require('webpack')
const { resolve } = require('path')
const webpackMerge = require('webpack-merge')
const ExtractTextPlugin = require("extract-text-webpack-plugin")
const ManifestPlugin = require('webpack-manifest-plugin')
const InterpolateHtmlPlugin = require('react-dev-utils/InterpolateHtmlPlugin')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const Package = require(resolve(__dirname, '..', 'package'))

const commonConfig = require(resolve(__dirname, 'base'))

module.exports = env => webpackMerge(commonConfig, {
  entry: {
    index: [
      'babel-polyfill/dist/polyfill.min.js',
      './index.js',
    ],
  },
  output: {
    pathinfo: false,
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
        test: /\.scss$/,
        loader: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            'css-loader',
            'resolve-url-loader',
            {
              loader: 'postcss-loader',
              options: {
                config: resolve(__dirname, '..', 'postcss.config.js'),
              },
            },
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
              }
            }
          ],
        }),
      },
    ]
  },
  plugins: [
    new webpack.LoaderOptionsPlugin({
      minimize: true,
      debug: false,
    }),
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: JSON.stringify('production')
      }
    }),
    new InterpolateHtmlPlugin({
      'NODE_ENV': process.env.NODE_ENV || 'development',
      'PUBLIC_URL': '/'
    }),
    new HtmlWebpackPlugin({
      title: Package.title,
      inject: true,
      template: resolve(__dirname, '..', 'static', 'index.html'),
      minify: {
        removeComments: true,
        collapseWhitespace: true,
        removeRedundantAttributes: true,
        useShortDoctype: true,
        removeEmptyAttributes: true,
        removeStyleLinkTypeAttributes: true,
        keepClosingSlash: true,
        minifyJS: true,
        minifyCSS: true,
        minifyURLs: true,
      }
    }),
    new webpack.optimize.OccurrenceOrderPlugin(),
    new webpack.optimize.UglifyJsPlugin({
      output: {
        comments: false,
      },
      beautify: false,
      mangle: true,
      compress: {
        warnings: false
      },
      comments: false,
      drop_console: true,
      drop_debugger: true,
      screw_ie8: false,
    }),
    new webpack.NoEmitOnErrorsPlugin(),
    new ExtractTextPlugin({
      filename: 'static/css/[name].css',
    }),
    new ManifestPlugin({
      fileName: 'asset-manifest.json'
    }),
  ],
})