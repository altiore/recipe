import { connect } from 'react-redux'
// import { createStructuredSelector } from 'reselect'

// import { units } from 'store/entity/units/selectors'
import { Select } from 'components/atoms'

export default connect(
  state => ({
    options: state.units.list,
  })
)(Select)
