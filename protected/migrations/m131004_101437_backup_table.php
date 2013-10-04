<?php

class m131004_101437_backup_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('backup', array(
        	'id' => "pk",
            'time' => "timestamp NOT NULL COMMENT 'Время загрузки'",
            'user_id' => "int NOT NULL COMMENT 'Инициатор'",
        ), 'ENGINE = MYISAM');
	}

	public function down()
	{
		$this->dropTable('backup');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}