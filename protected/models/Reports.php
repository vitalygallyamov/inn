<?php

/**
 * This is the model class for table "reports".
 *
 * The followings are the available columns in table 'reports':
 * @property integer $id
 * @property string $r_date
 * @property string $r_notice
 * @property string $r_customer
 * @property string $r_purchase
 * @property string $r_winner
 * @property integer $r_inn
 * @property integer $r_kpp
 * @property string $r_email
 * @property string $r_phone
 * @property double $r_nmc
 * @property double $r_provision
 * @property string $r_region
 * @property string $r_address
 * @property string $r_fio
 * @property integer $r_user_id
 */
class Reports extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reports';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('r_inn, r_kpp', 'length', 'max'=>30),
			array('r_nmc, r_provision', 'numerical'),
			array('r_notice, r_customer, r_purchase, r_winner, r_email, r_phone, r_region, r_address, r_fio', 'length', 'max'=>255),
			array('r_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, r_date, r_notice, r_customer, r_purchase, r_winner, r_inn, r_kpp, r_email, r_phone, r_nmc, r_provision, r_region, r_address, r_fio', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'r_date' => 'Дата протокола',
			'r_notice' => 'Извещение',
			'r_customer' => 'Заказчик (Организатор)',
			'r_purchase' => 'Закупка',
			'r_winner' => 'Победитель',
			'r_inn' => 'ИНН',
			'r_kpp' => 'КПП',
			'r_email' => 'Email',
			'r_phone' => 'Телефон',
			'r_nmc' => 'НМЦ контракта',
			'r_provision' => 'Обеспечение',
			'r_region' => 'Регион',
			'r_address' => 'Почтовый адрес',
			'r_fio' => 'ФИО',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('r_date',$this->r_date,true);
		$criteria->compare('r_notice',$this->r_notice,true);
		$criteria->compare('r_customer',$this->r_customer,true);
		$criteria->compare('r_purchase',$this->r_purchase,true);
		$criteria->compare('r_winner',$this->r_winner,true);
		$criteria->compare('r_inn',$this->r_inn, true);
		$criteria->compare('r_kpp',$this->r_kpp, true);
		$criteria->compare('r_email',$this->r_email,true);
		$criteria->compare('r_phone',$this->r_phone,true);
		$criteria->compare('r_nmc',$this->r_nmc);
		//var_dump($this->r_provision);
		$bounds = explode(',', $this->r_provision);
		if(count($bounds) > 2){
			$criteria->addBetweenCondition('r_provision', $bounds[0], $bounds[1]);
		}else{
			$criteria->compare('r_provision >',$this->r_provision);
		}
		$criteria->compare('r_region',$this->r_region,true);
		$criteria->compare('r_address',$this->r_address,true);
		$criteria->compare('r_fio',$this->r_fio,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reports the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	//get regions
	public static function getRegions(){
		$empty = array('' => 'Все');
		$regions = Yii::app()->db->createCommand()
			->selectDistinct('r_region')
			->from('reports')
			->order('r_region')
			->queryColumn();
		
		$result = array();
		if(!empty($regions))
			$result = $empty + array_combine($regions, $regions);
		
		return $result;
	}

	//get price bounds
	public static function priceBounds(){
		return array(
			0 => 'Все',
			'100000, 500000' => 'от 100 т.р. до 500 т.р.',
			'500000, 1000000' => 'от 500 т.р. до 1 млн.',
			1000000 => 'от 1 млн. и выше'
		);
	}

	//get dates filter array
	public static function dates(){
		$now = date('Y-m-d');
		$prev = date('Y-m-d', strtotime($now . " - 1 day"));
		return array(
			'' =>  'Все',
			$now => 'Сегодня',
			$prev => 'Вчера'
		);
	}
}
