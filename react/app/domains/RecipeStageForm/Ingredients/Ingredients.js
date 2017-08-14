import React from 'react'
import PropTypes from 'prop-types'
import { Field } from 'redux-form'
import RemoveIcon from 'react-icons/lib/md/highlight-remove'

import { Button } from 'components/atoms'
import Input from 'containers/Input'
import Ingredient from './Ingredient'
import Unit from './Unit'
import './styles.scss'

const Ingredients = ({ fields, meta: { error, submitFailed }, label }) => (
  <div>
    <h3>{label}</h3>
    <ul>
      {fields.map((member, index) =>
        <li key={index} className='ingredient-field'>
          <h4>
            {index + 1}&nbsp;
          </h4>
          <Field
            name={`${member}.name`}
            component={Ingredient}
            label='Ингредиент'
            placeholder='Выбери ингредиент...'
          />
          <Field
            name={`${member}.amount`}
            component={Input}
            label='Количество'
          />
          <Field
            name={`${member}.unit`}
            component={Unit}
            label='Единица измерения'
          />
          <a
            href='#'
            onClick={() => fields.remove(index)}
            className='recipe-stage-form__remove-wrapper'
          >
            <RemoveIcon className='recipe-stage-form__remove-button' />
          </a>
        </li>
      )}
      <li>
        <Button type='button' onClick={() => fields.push({})}>
          Добавить ингредиент
        </Button>
        {(submitFailed && error) && (
          <span>{error}</span>
        )}
      </li>
    </ul>
  </div>
)

Ingredients.propTypes = {
  fields: PropTypes.object,
  meta: PropTypes.shape({
    error: PropTypes.string,
    submitFailed: PropTypes.func,
  }).isRequired,
  label: PropTypes.string,
}

export default Ingredients
