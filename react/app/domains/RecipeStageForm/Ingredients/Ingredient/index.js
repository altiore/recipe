import { connect } from 'react-redux'
import { createStructuredSelector } from 'reselect'

import { ingredients } from 'store/entity/ingredients/selectors'
import { Select } from 'components/atoms'

export default connect(
  createStructuredSelector({
    options: ingredients,
  })
)(Select)
