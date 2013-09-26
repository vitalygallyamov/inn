<?php

class m130925_110216_alter_companies extends CDbMigration
{
	public function up()
	{
		$this->addColumn('companies', 'c_status', 'TINYINT DEFAULT 0 COMMENT "Статус"');
	}

	public function down()
	{
		$this->dropColumn('companies', 'c_status');
	}
}