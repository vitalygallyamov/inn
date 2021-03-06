<?php
/* @var $this CsvController */

$this->breadcrumbs=array(
	'Csv',
);
?>
<h1>Загрузить файл</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'csv-form',
	'action' => '/csv/parse',
	'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Загрузить'); ?>
	</div>

<?php $this->endWidget(); ?>