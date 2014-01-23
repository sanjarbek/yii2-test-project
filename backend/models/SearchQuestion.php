<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Question;

/**
 * SearchQuestion represents the model behind the search form about Question.
 */
class SearchQuestion extends Model
{
	public $id;
	public $title;
	public $context;
	public $status;
	public $created_at;
	public $updated_at;
	public $created_user;
	public $updated_user;

	public function rules()
	{
		return [
			[['id', 'status', 'created_at', 'updated_at', 'created_user', 'updated_user'], 'integer'],
			[['title', 'context'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
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

	public function search($params)
	{
		$query = Question::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'title', true);
		$this->addCondition($query, 'context', true);
		$this->addCondition($query, 'status');
		$this->addCondition($query, 'created_at');
		$this->addCondition($query, 'updated_at');
		$this->addCondition($query, 'created_user');
		$this->addCondition($query, 'updated_user');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
