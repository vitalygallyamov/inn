<?php

class ReportsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/reports_layout';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'roles'=>array('user'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Reports;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Reports']))
		{
			$model->attributes=$_POST['Reports'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Reports']))
		{
			$model->attributes=$_POST['Reports'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Reports');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Reports('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reports']))
			$model->attributes=$_GET['Reports'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Upload csv file
	 */
	public function actionUpload(){
		$model = new CsvFileForm;
		$model->file = CUploadedFile::getInstance($model, "file");

		if($model->file && $model->validate()){
			$this->parseCSV($model->file);
			$this->redirect(array('admin'));
		}

		$this->render('upload', array('model' => $model));
	}

	/**
	 * Parse csv file
	 */
	private function parseCSV($file){

		$row = 1;
		$dbCommand =  Yii::app()->db->createCommand();

		if (($handle = fopen($file->tempName, "r")) !== FALSE) {
			//$count = 100;
		    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		    	if($row != 1){

			        $num = count($data);			        
			        $columns = array('r_user_id' => Yii::app()->user->id);

			        for ($c=0; $c < $num; $c++) {
			        	switch ($c) {
			        		case 0: //date
								$dateTime = strtotime($data[$c]);
								$columns['r_date'] = date('Y-m-d H:i:s', $dateTime);
			        			break;
			        		case 1: //notice
			        			$columns['r_notice'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        		case 2: //customer
			        			$columns['r_customer'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        		case 3: //purchase
			        			$columns['r_purchase'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        		case 4: //winner
			        			$columns['r_winner'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        		case 5: //inn
			        			$columns['r_inn'] = $data[$c];
			        			break;
			        		case 6: //kpp
			        			$columns['r_kpp'] = $data[$c];
			        			break;
			        		case 7: //email
			        			$columns['r_email'] = $data[$c];
			        			break;
			        		case 8: //phone
			        			$columns['r_phone'] = $data[$c];
			        			break;
			        		case 9: //nmc
			        			$data[$c] = str_replace(' ', '', $data[$c]);
			        			$columns['r_nmc'] = str_replace(',', '.', $data[$c]);
			        			break;
			        		case 10: //provision
			        			$data[$c] = str_replace(' ', '', $data[$c]);
			        			$columns['r_provision'] = str_replace(',', '.', $data[$c]);
			        			break;
			        		case 11: //region
			        			$columns['r_region'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        		case 12: //address
			        			$columns['r_address'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        		case 13: //fio
			        			$columns['r_fio'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        	}
			        }
			        //print_r($columns);
			        $dbCommand->insert('reports', $columns);
			        // die();
			    }
		        
		        //if($count == 0) break;
		        
		        //$count--;
		        $row++;
		    }
		    fclose($handle);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Reports the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Reports::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Reports $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='reports-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
