<?php

class m130919_095202_comments_table extends CDbMigration
{
	public function up()
	{
		 $this->createTable('comments', array(
        	'id' => "pk",
            'text' => "text NOT NULL COMMENT 'Текст'",
            'user_id' => "int NOT NULL COMMENT 'Автор комментария'",
            'company_id' => "varchar(30) NOT NULL COMMENT 'Компания'",
        ), 'ENGINE = MYISAM');

		$this->addForeignKey('com_fk1', 'comments', 'user_id', 'users', 'id');
		$this->addForeignKey('com_fk2', 'comments', 'company_id', 'companies', 'c_inn');
	}

	public function down()
	{
		$this->dropTable('comments');
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