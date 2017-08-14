import React from 'react'
import PropTypes from 'prop-types'
import { reduxForm, Form, Field, FieldArray } from 'redux-form'

import { File, TextArea, Button } from 'components/atoms'
import Input from 'containers/Input'
import Ingredients from './Ingredients'
import RecipeCategories from './RecipeCategories'
import './styles.scss'

const RecipeStageFormView = ({ handleSubmit }) => (
  <Form onSubmit={handleSubmit} className='recipe-stage-form'>

    <Field
      name='name'
      showLabel
      label='Название'
      placeholder='Название рецепта или этапа (шага)'
      component={Input}
    />

    <Field
      name='categories'
      showLabel
      label='Категории'
      placeholder='Рецепт принадлежит категориям...'
      component={RecipeCategories}
    />

    <Field
      name='image'
      showLabel
      label='Главная картинка рецепта или картинка шага'
      component={File}
    />

    <Field
      name='text'
      showLabel
      label='Описание'
      placeholder='Введи подробное описание рецепта...'
      component={TextArea}
    />

    <FieldArray
      name='ingredients'
      label='Ингредиенты'
      component={Ingredients}
    />

    <Button type='submit'>
      Сохранить
    </Button>

  </Form>
)

RecipeStageFormView.propTypes = {
  handleSubmit: PropTypes.func,
}

export default reduxForm({
  form: 'RecipeStageForm',
  destroyOnUnmount: false,
  initialValues: {
    // ingredients: [{}],
  },
})(RecipeStageFormView)
