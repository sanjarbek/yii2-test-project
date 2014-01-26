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

	<?php
	$form = ActiveForm::begin([
//				'options' => ['class' => 'form-horizontal'],
//				'fieldConfig' => ['inputOptions' => ['class' => 'input-xlarge']],
	]);
	?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => 20]) ?>

	<?php // $form->field($model, 'content')->textarea(['rows' => 6]) ?>
	<?php
	echo yii\imperavi\Widget::widget([
		// You can either use it for model attribute
		'model' => $model,
		'attribute' => 'content',
		// or just for input field
//		'name' => 'my_input_name',
		// Some options, see http://imperavi.com/redactor/docs/
		'options' => [
			'toolbar' => true,
			'uploadFields' => [
				'_csrf' => \yii::$app->request->csrfToken,
			],
			'imageUpload' => $this->context->createUrl('/test/imageupload'),
			'imageUploadErrorCallback' => 'function(json)
            {
                alert(json.error);
                alert(json.anothermessage);
            }',
			'fileUpload' => $this->context->createUrl('/test/fileupload'),
			'fileUploadErrorCallback' => 'function(json)
            {
                alert(json.error);
                alert(json.anothermessage);
            }',
//			'iframe' => true,
//			'fileUpload' => true,
//			'imageList' => true,
//			'css' => 'wym.css',
		],
//		'plugins' => [
//			'fullscreen',
//			'fontsize',
//			'clips',
//		]
	]);
	?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
