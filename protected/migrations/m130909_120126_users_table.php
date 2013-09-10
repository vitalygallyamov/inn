<?php

class m130909_120126_users_table extends CDbMigration
{
	private $salt = 'salt_123456_INN';

	public function up()
	{
		$this->createTable('users', array(
            'id' => 'pk',
            'fio' => "string NOT NULL COMMENT 'ФИО'",
            'login' => "string NOT NULL COMMENT 'Логин'",
            'pass' => "string NOT NULL COMMENT 'Пароль'",
            'role' => "string NOT NULL COMMENT 'Права'"
        ), 'ENGINE = MYISAM');

        $this->insert('users', array(
        	'fio' => 'Администратор',
        	'login' => 'admin',
        	'pass' => md5($this->salt.'admin1234'),
        	'role' => 'admin'
        ));
	}

	public function down()
	{
		$this->dropTable('users'); 
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