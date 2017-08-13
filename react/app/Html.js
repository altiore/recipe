import React from 'react'
import PropTypes from 'prop-types'
import { filter } from 'lodash'

import assets from '../dist/asset-manifest.json'

const css = filter(assets, value => value.match(/\.css$/))
const js = filter(assets, value => value.match(/\.js$/))

const Html = ({ helmet, content }) => (
  <html {...helmet.htmlAttributes.toComponent()}>
    <head>
      <meta charSet='urf-8' />
      <meta name='viewport' content='width=device-width, initial-scale=1.0' />
      <meta httpEquiv='X-UA-Compatible' content='ie=edge' />
      <meta name='robots' content='index, follow' />
      {helmet.title.toComponent()}
      {helmet.meta.toComponent()}
      <link rel='shortcut icon' href='/favicon.ico' />
      <link
        href='//fonts.googleapis.com/css?family=Exo+2:400,500|Roboto|Neucha|Philosopher|PT+Sans+Narrow'
        rel='stylesheet'
      />
      {css.map((href, i) => (
        <link key={i} href={`/${href}`} rel='stylesheet' />
      ))}
      {helmet.link.toComponent()}
    </head>
    <body {...helmet.bodyAttributes.toComponent()}>
      <div id='root' dangerouslySetInnerHTML={ {__html: content} } />
      {js.map((script, i) => (
        <script key={i} src={`/${script}`} />
      ))}
    </body>
  </html>
)

Html.propTypes = {
  helmet: PropTypes.object.isRequired,
  content: PropTypes.string,
}

export default Html
