<?php

namespace app\models;

/**
 * This is the model class for table "questions".
 *
 * @property integer $id
 * @property string $title
 * @property string $context
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 */
class Question extends \yii\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'questions';
	}

	public function behaviors() {
		return [
			'timestamp' => [
				'class' => 'yii\behaviors\AutoTimestamp',
				'attributes' => [
					\yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
					\yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['title', 'context', 'created_at', 'updated_at', 'created_user', 'updated_user'], 'required'],
			[['context'], 'string'],
			[['status', 'created_at', 'updated_at', 'created_user', 'updated_user'], 'integer'],
			[['title'], 'string', 'max' => 100]
		];
	}

	public function beforeSave() {
		if ($this->isNewRecord) {
			$this->created_user = \yii::$app->user->id;
			$this->updated_user = \yii::$app->user->id;
		} else {
			$this->updated_user = \yii::$app->user->id;
		}
		parent::beforeSave();
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'title' => 'Title',
			'context' => 'Context',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'created_user' => 'Created User',
			'updated_user' => 'Updated User',
		];
	}

}
