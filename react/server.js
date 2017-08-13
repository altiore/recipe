'use strict'

require('dotenv').config()
const path = require('path')
const express = require('express');
const webpack = require('webpack');
const config = require('./webpack/development');

const app = express();
const compiler = webpack(config);
const PORT = process.env.PORT || 8080;

app.use(require('webpack-dev-middleware')(compiler, {
  host: 'localhost',
  port: PORT,
  publicPath: config.output.publicPath,
  historyApiFallback: true,
  hot: true,
  inline: true,
  quiet: false,
  noInfo: true,
  reload: true,
  contentBase: path.resolve(__dirname, 'dist'),
  stats: {
    colors: true,
  },
}));

app.use(require('webpack-hot-middleware')(compiler))

app.use('*', function (req, res, next) {
  var filename = path.join(compiler.outputPath,'index.html');
  compiler.outputFileSystem.readFile(filename, function(err, result){
    if (err) {
      return next(err)
    }
    res.set('content-type','text/html')
    res.send(result)
    res.end()
  })
})

app.listen(PORT, 'localhost', err => {
  if (err) {
    return console.error(err);
  }

  console.log(`Listening at http://localhost:${PORT}`)
})
