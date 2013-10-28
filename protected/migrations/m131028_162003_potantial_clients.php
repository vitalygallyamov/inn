<?php

class m131028_162003_potantial_clients extends CDbMigration
{
	public function up()
	{

		$this->createTable('potantial_clients', array(
            'user_id' => "int NOT NULL",
            'company_id' => "varchar(30) NOT NULL",
            //'report_id' => "int NOT NULL",
            'PRIMARY KEY (user_id, company_id)'
        ), 'ENGINE = MYISAM');
	}

	public function down()
	{
		$this->dropTable('potantial_clients');
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