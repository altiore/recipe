<?php
namespace altiore\recipe\forms;

use altiore\base\models\Image;
use Yii;
use altiore\recipe\models\RecipeStage;
use yii\base\Model;
use yii\web\UploadedFile;

class RecipeStageForm extends Model
{
    public $name;
    public $text;
    public $description;
    /**
     * @var UploadedFile
     */
    public $image;
    public $ingredients = [];
    public $stages = [];
    public $is_published;

    /**
     * @var RecipeStage
     */
    public $recipeStage;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text', 'description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'mimeTypes' => ['image/*']],
            [['ingredients', 'stages'], 'safe'],
            ['is_published', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'ingredients' => 'Ingredients',
        ];
    }

    public function init()
    {
        if (!Yii::$app->request->post() && !$this->recipeStage->isNewRecord) {
            $this->setAttributes($this->recipeStage->attributes, false);
        }
    }

    /**
     * @return bool
     */
    public function save()
    {
        if ($this->validate()) {

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $this->recipeStage->setAttributes($this->attributes);
                if (!$this->recipeStage->save()) {
                    throw new \Exception();
                }

                $this->recipeStage->unlinkAll('stages', true);
                $stages = [];
                $hasStages = false;
                $order = 1;
                foreach ($this->stages as $stage) {
                    if (array_key_exists('id', $stage) && $stage['id'] && $stage['id'] != $this->recipeStage->id) {
                        $stageModel = RecipeStage::findOne($stage['id']);
                        if ($stageModel !== null) {
                            $this->recipeStage->link('stages', $stageModel, [
                                'order' => $order++,
                            ]);
                            $stages[] = $stageModel;
                        }
                    } elseif (array_key_exists('id', $stage) && $stage['id'] === $this->recipeStage->id) {
                        $this->addError('name', 'Ты не можешь добавить рецепт как стадию самого себя!');
                    }
                }
                if (!empty($stages)) {
                    $hasStages = true;
                }

                $this->recipeStage->unlinkAll('ingredients', true);
                if ($hasStages === false) {
                    foreach ($this->ingredients as $ingredient) {
                        if (array_key_exists('name', $ingredient) && $ingredient['name']) {
                            $ingredientModel = new IngredientForm([
                                'recipeStage' => $this->recipeStage,
                            ]);
                            $ingredientModel->setAttributes($ingredient);
                            if (!$ingredientModel->save()) {
                                $this->addErrors([
                                    'ingredients' => $ingredientModel->getFirstErrors()
                                ]);
                                throw new \Exception();
                            }
                        }
                    }
                }

                if ($this->image instanceof UploadedFile) {
                    if (!($fullFileName = Image::saveImage($this->recipeStage, $this->image))) {
                        throw new \Exception();
                    }
                }


                $transaction->commit();
            } catch (\Exception $exception) {
                if (isset($fullFileName) && file_exists($fullFileName)) {
                    unlink($fullFileName);
                }
                $transaction->rollBack();

                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * @param array $data
     * @param null $formName
     * @return bool
     */
    public function load($data, $formName = null)
    {
        $parentResult = parent::load($data, $formName);
        if (!$parentResult) {
            return false;
        }
        $this->image = UploadedFile::getInstance($this, 'image');

        $this->ingredients = [];
        if ($post = Yii::$app->request->post('RecipeIngredientLink')) {
            $this->ingredients = array_merge($this->ingredients, $post);
        }
        if ($post = Yii::$app->request->post('IngredientForm')) {
            $this->ingredients = array_merge($this->ingredients, $post);
        }

        if ($post = Yii::$app->request->post('RecipeStage')) {
            $this->stages = $post;
        }

        if (empty($this->image) && $this->recipeStage->isNewRecord) {
            $this->addError('image', 'Картина обязательна!');
            return false;
        }

        return true;
    }
}
