import React from 'react'
import { Provider } from 'react-redux'
import { renderToString, renderToStaticMarkup } from 'react-dom/server'
import { StaticRouter } from 'react-router-dom'
import { Helmet } from 'react-helmet'

import createStore from 'store/createStore'
import Root from './root'
import HtmlLayout from './Html'

let context = {}

function renderHtml (data) {
  const main = renderToString(
    <Provider store={createStore(undefined, null)}>
      <StaticRouter
        location={data.path}
        context={context}
      >
        <Root />
      </StaticRouter>
    </Provider>
  )

  const helmet = Helmet.renderStatic()

  return `<!doctype html>` + renderToStaticMarkup(<HtmlLayout helmet={helmet} content={main} />)
}

export default function render (locals, callback) {
  callback(null, renderHtml(locals))
}
