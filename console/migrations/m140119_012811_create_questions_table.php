<?php

use yii\db\Schema;

class m140119_012811_create_questions_table extends \yii\db\Migration
{

	public function up() {
		$this->createTable('questions', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . '(100) NOT NULL',
			'context' => Schema::TYPE_TEXT . ' NOT NULL',
			'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
			'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
			'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
			'created_user' => Schema::TYPE_INTEGER . ' NOT NULL',
			'updated_user' => Schema::TYPE_INTEGER . ' NOT NULL',
		]);
	}

	public function down() {
		$this->dropTable('questions');
	}

}
