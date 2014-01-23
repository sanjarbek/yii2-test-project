<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\SearchQuestion $searchModel
 */
$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

	<p>
		<?= Html::a('Create Question', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php
	echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'filterPosition' => GridView::FILTER_POS_FOOTER,
//		'showFooter' => true,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'id',
			'title',
			'context:ntext',
			'status:boolean:Статус',
			['class' => 'yii\grid\ActionColumn'],
		],
	]);
	?>

</div>
