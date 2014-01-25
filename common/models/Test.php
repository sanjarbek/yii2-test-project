<?php

namespace common\models;

/**
 * This is the model class for table "tests".
 *
 * @property string $id
 * @property string $name
 * @property string $content
 */
class Test extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tests';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'content'], 'required'],
			[['content'], 'string'],
			[['name'], 'string', 'max' => 20]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'content' => 'Content',
		];
	}
}
