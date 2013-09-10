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
            'r_winner' => "string COMMENT 'Победитель'",
            'r_inn' => "int COMMENT 'ИНН'",
            'r_kpp' => "int COMMENT 'КПП'",
            'r_email' => "string COMMENT 'Email'",
            'r_phone' => "string COMMENT 'Телефон'",
            'r_nmc' => "double COMMENT 'НМЦ контракта'",
            'r_provision' => "double COMMENT 'Обеспечение'",
            'r_region' => "string COMMENT 'Регион'",
            'r_address' => "string COMMENT 'Почтовый адрес'",
            'r_fio' => "string COMMENT 'ФИО'",
            'r_user_id' => "int NOT NULL COMMENT 'Пользователь'"
        ), 'ENGINE = MYISAM');

	}

	public function down()
	{
		$this->dropTable('reports'); 
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