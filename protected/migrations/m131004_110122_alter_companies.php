<?php

class m131004_110122_alter_companies extends CDbMigration
{
	public function up()
	{
		$this->addColumn('companies', 'c_backup_id', 'int NOT NULL COMMENT "Backup id"');
	}

	public function down()
	{
		$this->dropColumn('companies', 'c_backup_id');
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