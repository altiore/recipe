const FILE_NAME = process.env.STATIC || process.env.NODE_ENV || 'development'

process.traceDeprecation = true

module.exports = require(`./webpack/${FILE_NAME}.js`)
