import React, { PureComponent } from 'react'
import PropTypes from 'prop-types'

import RecipeStageFormView from './RecipeStageFormView'

class RecipeStageForm extends PureComponent {
  static propTypes = {
    fetchIngredients: PropTypes.func.isRequired,
    fetchUnits: PropTypes.func.isRequired,
  }

  componentDidMount () {
    const { fetchIngredients, fetchUnits } = this.props
    fetchIngredients()
    fetchUnits()
  }

  handleSubmit = (values) => console.log('handleSubmit', values)

  render () {
    return (
      <RecipeStageFormView {...this.props} onSubmit={this.handleSubmit} />
    )
  }
}

export default RecipeStageForm
