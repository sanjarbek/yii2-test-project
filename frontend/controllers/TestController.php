<?php

namespace frontend\controllers;

use common\models\Test;
use common\models\TestQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;
use yii\helpers\Json;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
{

	public function behaviors() {
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	public function actions() {
		return [
			'imageupload' => [
				'class' => 'frontend\actions\ImageUploadAction',
				'uploadPath' => \yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR,
				'uploadUrl' => '/images',
				'uploadCreate' => true,
				'permissions' => 0755,
			],
		];
	}

//	public function actionImageupload() {
//		$directory = \yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'images/';
//		$file = md5(date('YmdHis')) . '.' . pathinfo(@$_FILES['file']['name'], PATHINFO_EXTENSION);
//
//		if (move_uploaded_file(@$_FILES['file']['tmp_name'], $directory . $file)) {
//			$array = [
//				'filelink' => '/images/' . $file
//			];
//		} else {
//			$array = [
//				'error' => 'Hi! It\'s error message',
//				'anothermessage' => 'And another message.'
//			];
//		}
//		return Json::encode($array);
//	}

	public function actionFileupload() {
		$directory = \yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'images/';
		$file = md5('file_' . date('YmdHis')) . '.' . pathinfo(@$_FILES['file']['name'], PATHINFO_EXTENSION);

		if (move_uploaded_file(@$_FILES['file']['tmp_name'], $directory . $file)) {
			$array = [
				'filelink' => '/images/' . $file
			];
		} else {
			$array = [
				'error' => 'Hi! It\'s error message',
				'anothermessage' => 'And another message.'
			];
		}
		return Json::encode($array);
	}

	/**
	 * Lists all Test models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new TestQuery;
		$dataProvider = $searchModel->search($_GET);

		return $this->render('index', [
					'dataProvider' => $dataProvider,
					'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Test model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
					'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Test model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Test;

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Test model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Test model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Test model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Test the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if ($id !== null && ($model = Test::find($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
