import React from 'react'
import ReactDOM from 'react-dom'
import { Provider } from 'react-redux'
import Root from './root'

import createStore from './createStore'

const rootPoint = document.getElementById('root')

ReactDOM.render((
  <Provider store={createStore(undefined, null)}>
    <Root />
  </Provider>
), rootPoint)
