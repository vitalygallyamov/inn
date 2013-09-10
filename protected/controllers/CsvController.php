<?php

class CsvController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl'
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'roles'=>array('user'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$model = new CsvFileForm;
		$this->render('index', array('model' => $model));
	}

	public function actionParse(){
		$model = new CsvFileForm;

		$model->file = CUploadedFile::getInstance($model, "file");

		if($model->validate()){
			

			if($model->validate()){

				/*$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
				//Yii::import('ext.Classes.PHPExcel.*');
				// Turn off our amazing library autoload 
    			//spl_autoload_unregister(array('YiiBase','autoload'));
    			include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

				//echo Yii::getPathOfAlias('ext.PHPExcel.Classes');die();
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				$objReader->setReadDataOnly(true);
				$objPHPExcel = $objReader->load($model->file->tempName);
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(1);
				//objWorksheet = $objPHPExcel->getActiveSheet();
				echo '<table border=1>' . "\n";
				foreach ($objWorksheet->getRowIterator() as $row) {
				  echo '<tr>' . "\n";
				  $cellIterator = $row->getCellIterator();
				  $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
				                                                     // even if it is not set.
				                                                     // By default, only cells
				                                                     // that are set will be
				                                                     // iterated.
				  foreach ($cellIterator as $cell) {
				    echo '<td>' . print_r($cell) . '</td>' . "\n";
				  }
				  echo '</tr>' . "\n";
				}
				echo '</table>' . "\n";
				//spl_autoload_register(array('YiiBase','autoload'));
				die();*/

				$row = 1;
				$dbCommand =  Yii::app()->db->createCommand();

				if (($handle = fopen($model->file->tempName, "r")) !== FALSE) {
					//$count = 100;
				    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				    	if($row != 1){

					        $num = count($data);
					        echo "<p> $num полей в строке $row: <br /></p>\n";
					        
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
				Yii::app()->end();
			}
		}

		$this->render('index', array('model' => $model));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}