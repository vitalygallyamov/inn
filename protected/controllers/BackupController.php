<?php

class BackupController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Backup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Backup']))
			$model->attributes=$_GET['Backup'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionBack($id){

		$backup = $this->loadModel($id);

		$dbCommand =  Yii::app()->db->createCommand();

		$dbCommand->delete('reports', 'r_backup_id=:b_id', array(':b_id' => $backup->id));
		$dbCommand->delete('companies', 'c_backup_id=:b_id', array(':b_id' => $backup->id));

		$backup->delete();

		$this->redirect('/backup/admin');
	}

	public function actionDestroy(){
		$dbCommand =  Yii::app()->db->createCommand();

		$dbCommand->truncateTable('reports');
		$dbCommand->truncateTable('companies');
		$dbCommand->truncateTable('comments');
		$dbCommand->truncateTable('backup');
		$dbCommand->truncateTable('user_companies');

		$this->redirect('/reports/admin');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Backup the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Backup::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Backup $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='backup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
