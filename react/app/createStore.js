import { createStore as reduxCreateStore, applyMiddleware, compose, combineReducers } from 'redux'
import thunk from 'redux-thunk'

import clientsMiddleware from 'store/clients/clientsMiddleware'
import ingredients from 'store/entity/ingredients/reducer'
import units from 'store/entity/units/reducer'
import recipeCategories from 'store/entity/recipeCategories/reducer'
import { reducer as form } from 'redux-form'

export const rootReducer = combineReducers({
  form,
  ingredients,
  units,
  recipeCategories,
})

const createStore = (initialState, historyMiddleware) => {
  let composedMiddlewares
  if (historyMiddleware) {
    composedMiddlewares = compose(
      applyMiddleware(historyMiddleware),
      applyMiddleware(thunk, clientsMiddleware),
    )
  } else {
    composedMiddlewares = applyMiddleware(thunk, clientsMiddleware)
  }

  const store = reduxCreateStore(
    rootReducer,
    initialState,
    composedMiddlewares
  )

  if (module.hot) {
    module.hot.accept('./createStore', () => {
      const nextRootReducer = require('./createStore').rootReducer
      store.replaceReducer(nextRootReducer)
    })
  }

  return store
}

export default createStore
