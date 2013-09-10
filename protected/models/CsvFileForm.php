<?php

class CsvFileForm extends CFormModel{

	public $file;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('file', 'required'),
			array('file', 'file', 'types' => 'csv'),
			// array('file', 'file', 'types' => 'csv, xls'),
			// email has to be a valid email address

		);
	}

	public function attributeLabels()
	{
		return array(
			'file'=>'Файл',
		);
	}
}