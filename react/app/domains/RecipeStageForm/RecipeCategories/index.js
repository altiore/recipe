import { connect } from 'react-redux'
import { createStructuredSelector } from 'reselect'

import { recipeCategories } from 'store/entity/recipeCategories/selectors'
import { Multiselect } from 'components/atoms'

export default connect(
  createStructuredSelector({
    options: recipeCategories,
  })
)(Multiselect)
