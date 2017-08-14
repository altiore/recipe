import { connect } from 'react-redux'
import { createStructuredSelector } from 'reselect'

import { recipeCategories } from 'store/entity/recipeCategory/selectors'
import { Multiselect } from 'components/atoms'

export default connect(
  createStructuredSelector({
    options: recipeCategories,
  })
)(Multiselect)
