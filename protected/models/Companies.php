<?php

/**
 * This is the model class for table "companies".
 *
 * The followings are the available columns in table 'companies':
 * @property string $c_inn
 * @property string $с_name
 * @property string $c_kpp
 * @property string $c_email
 * @property string $c_phone
 * @property string $c_address
 * @property string $c_fio
 */
class Companies extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'companies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_status', 'numerical', 'integerOnly'=>true),
			array('c_inn, c_kpp', 'length', 'max'=>30),
			array('c_name, c_email, c_phone, c_address, c_fio', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('c_inn, c_name, c_kpp, c_email, c_phone, c_address, c_fio', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comments'=>array(self::HAS_MANY, 'Comments', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'c_inn' => 'ИНН',
			'c_name' => 'Название',
			'c_kpp' => 'КПП',
			'c_email' => 'Email',
			'c_phone' => 'Телефон',
			'c_address' => 'Почтовый адрес',
			'c_fio' => 'ФИО',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('c_inn',$this->c_inn,true);
		$criteria->compare('c_name',$this->c_name,true);
		$criteria->compare('c_kpp',$this->c_kpp,true);
		$criteria->compare('c_email',$this->c_email,true);
		$criteria->compare('c_phone',$this->c_phone,true);
		$criteria->compare('c_address',$this->c_address,true);
		$criteria->compare('c_fio',$this->c_fio,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Companies the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
