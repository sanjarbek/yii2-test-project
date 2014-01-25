<?php

use yii\db\Schema;

class m140125_234435_create_tests_table extends \yii\db\Migration
{

	public function up() {
		$this->createTable('tests', [
			'id' => Schema::TYPE_BIGPK,
			'name' => Schema::TYPE_STRING . '(20) NOT NULL',
			'content' => Schema::TYPE_TEXT . ' NOT NULL',
		]);
	}

	public function down() {
		$this->dropTable('tests');
	}

}
