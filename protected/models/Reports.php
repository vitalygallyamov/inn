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
 * @property string $r_inn
 * @property double $r_nmc
 * @property double $r_provision
 * @property string $r_region
 * @property integer $r_status
 */
class Reports extends CActiveRecord
{

	public $hidden = true;
	public $winners = false;
	public $potantials = false;
	public $c_name;
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
			array('r_status', 'numerical', 'integerOnly'=>true),
			array('r_nmc, r_provision', 'numerical'),
			array('r_notice, r_customer, r_purchase, r_region', 'length', 'max'=>255),
			array('r_inn', 'length', 'max'=>30),
			array('r_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, r_date, r_notice, r_customer, r_purchase, r_inn, r_nmc, r_provision, r_region, r_status', 'safe', 'on'=>'search'),
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
			'company'=>array(self::BELONGS_TO, 'Companies', 'r_inn'),
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
			'r_inn' => 'ИНН',
			'r_nmc' => 'НМЦ контракта',
			'r_provision' => 'Обеспечение',
			'r_region' => 'Регион',
			'r_status' => 'Статус',
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
		//$criteria->compare('r_date',$this->r_date,true);

		if($this->r_date){
			$date = date('Y-m-d', strtotime($this->r_date));
			$criteria->addSearchCondition('r_date', $date, true);
		}

		$criteria->compare('r_notice',$this->r_notice,true);
		$criteria->compare('r_customer',$this->r_customer,true);
		$criteria->compare('r_purchase',$this->r_purchase,true);
		$criteria->compare('r_inn',$this->r_inn,true);
		$criteria->compare('r_nmc',$this->r_nmc);
		
		$bounds = explode(',', $this->r_provision);
		if(count($bounds) == 2){
			$criteria->addBetweenCondition('r_provision', $bounds[0], $bounds[1]);
		}else{
			$criteria->compare('r_provision >',$this->r_provision);
		}
		
		$criteria->compare('r_region',$this->r_region,true);
		$criteria->compare('r_status',$this->r_status);

		//only visible companies
		$criteria->with = array('company');
		if($this->hidden){
			$criteria->addCondition('c_status=0');
		}
		else{
			$criteria->addCondition('c_status=1');
		}

		$criteria->compare('company.c_name',$this->c_name,true);

		//winners
		if($this->winners){
			$user_id = Yii::app()->user->id;

			$user_ids = Yii::app()->db->createCommand()
				->select('company_id')
				->from('user_companies')
				->where('user_id=:user_id', array(':user_id' => $user_id))
				->queryColumn();
			 $criteria->addInCondition('r_inn', $user_ids); 
		}

		//potantials
		if($this->potantials){
			$user_id = Yii::app()->user->id;

			$user_ids = Yii::app()->db->createCommand()
				->select('company_id')
				->from('potantial_clients')
				->where('user_id=:user_id', array(':user_id' => $user_id))
				->queryColumn();
			 $criteria->addInCondition('r_inn', $user_ids); 
		}

		$sort = new CSort;
		$sort->attributes = array('company.c_count'=>array('asc'=>'company.c_count', 'desc'=>'company.c_count DESC'), '*');
		$sort->defaultOrder = array('date'=>TRUE);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => $sort,
			'pagination'=>array('pageSize'=>100),
		));
	}

	public function getC_name(){
		return $this->c_name;
	}
	public function setC_name($value){
		$this->c_name = $value;
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
			'1000000, 2000000' => 'от 1 до 2 млн.',
			'2000000, 3000000' => 'от 2 до 3 млн.',
			'3000000, 4000000' => 'от 3 до 4 млн.',
			'4000000, 5000000' => 'от 4 до 5 млн.',
			'5000000, 6000000' => 'от 5 до 6 млн.',
			'6000000, 7000000' => 'от 6 до 7 млн.',
			'7000000, 8000000' => 'от 7 до 8 млн.',
			'8000000, 9000000' => 'от 8 до 9 млн.',
			'9000000, 10000000' => 'от 9 до 10 млн.',
			10000000 => 'от 10 млн. и выше'
		);
	}

	public function hasWinner(){
		$company = Companies::model()->findByPk($this->r_inn);
		
		$winners = Yii::app()->db->createCommand()
			->select('*')
			->from('user_companies')
			->where('user_id=:u_id AND company_id=:c_id', array(':u_id' => Yii::app()->user->id, ':c_id' => $company->c_inn))
			->queryRow();

		return !empty($winners);
	}

	public function hasPotantial(){
		$company = Companies::model()->findByPk($this->r_inn);
		
		$winners = Yii::app()->db->createCommand()
			->select('*')
			->from('potantial_clients')
			->where('user_id=:u_id AND company_id=:c_id', array(':u_id' => Yii::app()->user->id, ':c_id' => $company->c_inn))
			->queryRow();

		return !empty($winners);
	}

	//get dates filter array
	/*public static function dates(){
		$now = date('Y-m-d');
		$prev = date('Y-m-d', strtotime($now . " - 1 day"));
		return array(
			'' =>  'Все',
			$now => 'Сегодня',
			$prev => 'Вчера'
		);
	}*/
}
