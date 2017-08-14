import React, { PureComponent } from 'react'
import PropTypes from 'prop-types'

import RecipeStageFormView from './RecipeStageFormView'

class RecipeStageForm extends PureComponent {
  static propTypes = {
    fetchIngredients: PropTypes.func.isRequired,
    fetchUnits: PropTypes.func.isRequired,
    fetchRecipeCategories: PropTypes.func.isRequired,
  }

  componentDidMount () {
    this.props.fetchIngredients()
    this.props.fetchUnits()
    this.props.fetchRecipeCategories()
  }

  handleSubmit = (values) => console.log('handleSubmit', values)

  render () {
    return (
      <RecipeStageFormView {...this.props} onSubmit={this.handleSubmit} />
    )
  }
}

export default RecipeStageForm
