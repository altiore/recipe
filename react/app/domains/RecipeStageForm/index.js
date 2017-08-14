import { connect } from 'react-redux'

import { fetchIngredients } from 'store/entity/ingredients/actions'
import { fetchUnits } from 'store/entity/units/actions'
import { fetchRecipeCategories } from 'store/entity/recipeCategories/actions'
import RecipeStageForm from './RecipeStageForm'

export default connect(null,
  {
    fetchIngredients,
    fetchUnits,
    fetchRecipeCategories,
  }
)(RecipeStageForm)
