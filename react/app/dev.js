import React from 'react'
import ReactDOM from 'react-dom'
import RedBox from 'redbox-react'
import { AppContainer } from 'react-hot-loader'
import { Provider } from 'react-redux'
import RootComponent from './root'
import { BrowserRouter as Router } from 'react-router-dom'
import createHistory from 'history/createBrowserHistory'
import { routerMiddleware } from 'react-router-redux'

import createStore from './createStore'
import 'mimic'

const history = createHistory()
const historyMiddleware = routerMiddleware(history)
const initialState = window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
const rootPoint = document.getElementById('root')

const store = createStore(initialState, historyMiddleware)

const render = Root => {
  try {
    ReactDOM.render((
      <AppContainer>
        <Provider store={store}>
          <Router history={history}>
            <Root />
          </Router>
        </Provider>
      </AppContainer>
    ), rootPoint)
  } catch (e) {
    ReactDOM.render(<RedBox error={e} />, rootPoint)
  }
}

render(RootComponent)

if (module.hot) {
  module.hot.accept('./root', () => render(RootComponent))
}
