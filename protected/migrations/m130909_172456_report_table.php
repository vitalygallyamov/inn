<?php

class m130909_172456_report_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('reports', array(
            'id' => 'pk',
            'r_date' => "datetime COMMENT 'Дата протокола'",
            'r_notice' => "string COMMENT 'Извещение'",
            'r_customer' => "string COMMENT 'Заказчик (Организатор)'",
            'r_purchase' => "string COMMENT 'Закупка'",
            //'r_winner' => "string COMMENT 'Победитель'",
            'r_inn' => "varchar(30) COMMENT 'ИНН'",
            //'r_kpp' => "varchar(30) COMMENT 'КПП'",
            //'r_email' => "string COMMENT 'Email'",
            //'r_phone' => "string COMMENT 'Телефон'",
            'r_nmc' => "double COMMENT 'НМЦ контракта'",
            'r_provision' => "double COMMENT 'Обеспечение'",
            'r_region' => "string COMMENT 'Регион'",
            'r_status' => "tinyint COMMENT 'Статус'",
            //'r_address' => "string COMMENT 'Почтовый адрес'",
            //'r_fio' => "string COMMENT 'ФИО'"
        ), 'ENGINE = MYISAM');

        $this->createTable('companies', array(
        	'c_inn' => "varchar(30) COMMENT 'ИНН'",
            'c_name' => "string COMMENT 'Название'",
            'c_kpp' => "varchar(30) COMMENT 'КПП'",
            'c_email' => "string COMMENT 'Email'",
            'c_phone' => "string COMMENT 'Телефон'",
            'c_address' => "string COMMENT 'Почтовый адрес'",
            'c_fio' => "string COMMENT 'ФИО'"
        ), 'ENGINE = MYISAM');

        $this->addPrimaryKey('pk_c', 'companies', 'c_inn');
        $this->addForeignKey('r_fk', 'reports', 'r_inn', 'companies', 'c_inn');
	}

	public function down()
	{
		$this->dropTable('reports');
		$this->dropTable('companies');
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