<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Test $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="test-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 20]) ?>

		<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
