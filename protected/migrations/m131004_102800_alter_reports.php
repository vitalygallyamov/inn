<?php

class m131004_102800_alter_reports extends CDbMigration
{
	public function up()
	{
		$this->addColumn('reports', 'r_backup_id', 'int NOT NULL COMMENT "Backup id"');
	}

	public function down()
	{
		$this->dropColumn('reports', 'r_backup_id');
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