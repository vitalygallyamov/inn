<?php

class m130925_163856_alter_company extends CDbMigration
{
	public function up()
	{
		$this->addColumn('companies', 'c_count', 'int DEFAULT 0 COMMENT "Выиграно"');

		$this->createTable('user_companies', array(
            'user_id' => "int NOT NULL",
            'company_id' => "varchar(30) NOT NULL",
            //'report_id' => "int NOT NULL",
            'PRIMARY KEY (user_id, company_id)'
        ), 'ENGINE = MYISAM');
	}

	public function down()
	{
		$this->dropColumn('companies', 'c_count');
		$this->dropTable('user_companies');
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