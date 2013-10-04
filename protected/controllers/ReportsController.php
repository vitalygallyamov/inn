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
		$comment = new Comments;
		$comment->user_id = Yii::app()->user->id;

		$model=new Reports('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reports']))
			$model->attributes=$_GET['Reports'];

		if(isset($_GET['hidden']))
			$model->hidden = false;

		if(isset($_GET['winners']))
			$model->winners = true;

		if(isset($_GET['Reports']['c_name']))
			$model->c_name = $_GET['Reports']['c_name'];

		if(isset($_GET['ajax']) && $_GET['ajax']==='reports-grid'){

			$this->renderPartial('admin',array(
				'model'=>$model,
				'comment' => $comment
			));
			Yii::app()->end();
		}

		$this->render('admin',array(
			'model'=>$model,
			'comment' => $comment
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
	 * Change winners
	 */

	public function actionChangeWinners($company_id, $action='add'){
		$cdb = Yii::app()->db->createCommand();

		$company = Companies::model()->findByPk($company_id);

		if($company === null) Yii::app()->end();

		$user_id = Yii::app()->user->id;

		$exist = $cdb->select('*')
		    ->from('user_companies')
		    ->where('company_id=:company_id AND user_id=:user_id', 
		    	array(':company_id'=>$company_id, ':user_id'=>$user_id)
		    )->queryRow();

		if($action == 'add'){
			if(empty($exist)){
				$cdb->insert('user_companies', array(
					'company_id' => $company_id,
					'user_id' => $user_id
				));
			}
		}elseif($action == 'delete'){
			if(!empty($exist)){
				$cdb->delete('user_companies', 'user_id=:u_id AND company_id=:company_id', array(
					':company_id' => $company_id,
					':u_id' => $user_id
				));
			}
		}

		Yii::app()->end();
	}

	/**
	 * Parse csv file
	 */
	private function parseCSV($file){

		$row = 1;
		$dbCommand =  Yii::app()->db->createCommand();

		if (($handle = fopen($file->tempName, "r")) !== FALSE) {
			
			// $count = 100;
		    
		    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		    	if($row != 1){

			        $num = count($data);

			        $r_columns = array(); // columns for `reports` table
			        $c_columns = array(); // columns for `companies` table

			        for ($c=0; $c < $num; $c++) {

			        	switch ($c) {
			        		case 0: //date
								$dateTime = strtotime($data[$c]);
								$r_columns['r_date'] = date('Y-m-d H:i:s', $dateTime);
			        			break;
			        		case 1: //notice
			        			$r_columns['r_notice'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        		case 2: //customer
			        			$r_columns['r_customer'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        		case 3: //purchase
			        			$r_columns['r_purchase'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        		case 4: //winner
			        			$c_columns['c_name'] = iconv('CP1251', 'UTF-8', $data[$c]); //company
			        			break;
			        		case 5: //inn
			        			$r_columns['r_inn'] = $data[$c];
			        			$c_columns['c_inn'] = $data[$c]; //company
			        			break;
			        		case 6: //kpp
			        			$c_columns['c_kpp'] = $data[$c]; //company
			        			break;
			        		case 7: //email
			        			$c_columns['c_email'] = $data[$c]; //company
			        			break;
			        		case 8: //phone
			        			$c_columns['c_phone'] = $data[$c]; //company
			        			break;
			        		case 9: //nmc
			        			$data[$c] = str_replace(' ', '', $data[$c]);
			        			$r_columns['r_nmc'] = str_replace(',', '.', $data[$c]);
			        			break;
			        		case 10: //provision
			        			$data[$c] = str_replace(' ', '', $data[$c]);
			        			$r_columns['r_provision'] = str_replace(',', '.', $data[$c]);
			        			break;
			        		case 11: //region
			        			$r_columns['r_region'] = iconv('CP1251', 'UTF-8', $data[$c]);
			        			break;
			        		case 12: //address
			        			$c_columns['c_address'] = iconv('CP1251', 'UTF-8', $data[$c]); //company
			        			break;
			        		case 13: //fio
			        			$c_columns['c_fio'] = iconv('CP1251', 'UTF-8', $data[$c]); //company
			        			break;
			        	}
			        }

			        
			        if(!empty($c_columns['c_inn']) && strlen(trim($c_columns['c_inn'])) > 0){
			        	
			        	//---add company
			        	$t = Companies::model()->findByPk($c_columns['c_inn']);

			        	if(Companies::model()->findByPk($c_columns['c_inn']) === null){
			        		//check on exist company in db
			        		//if no in db then add
			        		$dbCommand2 = Yii::app()->db->createCommand();
			        		$dbCommand2->insert('companies', $c_columns);
			        	}
			        	//increment company counter
			        	$sql="UPDATE companies SET c_count = c_count + 1 WHERE c_inn=:c_inn";
			        	$up_counter = Yii::app()->db->createCommand($sql);
			        	$up_counter->bindParam(":c_inn", $c_columns['c_inn'], PDO::PARAM_STR);
			        	$up_counter->execute();
			        	// $company = Companies::model()->findByPk($c_columns['c_inn']);
			        	// $company->updateCounters(array('c_count' => 1));
			        	//add row in `reports` table
			        	$dbCommand->insert('reports', $r_columns);
			        }			        
			        // die();
			    }
		        
		        // if($count == 0) break;
		        
		        // $count--;
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
