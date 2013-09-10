<?php
/* @var $this ReportsController */
/* @var $model Reports */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_date'); ?>
		<?php echo $form->textField($model,'r_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_notice'); ?>
		<?php echo $form->textField($model,'r_notice',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_customer'); ?>
		<?php echo $form->textField($model,'r_customer',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_purchase'); ?>
		<?php echo $form->textField($model,'r_purchase',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_winner'); ?>
		<?php echo $form->textField($model,'r_winner',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_inn'); ?>
		<?php echo $form->textField($model,'r_inn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_kpp'); ?>
		<?php echo $form->textField($model,'r_kpp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_email'); ?>
		<?php echo $form->textField($model,'r_email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_phone'); ?>
		<?php echo $form->textField($model,'r_phone',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_nmc'); ?>
		<?php echo $form->textField($model,'r_nmc'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_provision'); ?>
		<?php echo $form->textField($model,'r_provision'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_region'); ?>
		<?php echo $form->textField($model,'r_region',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_address'); ?>
		<?php echo $form->textField($model,'r_address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_fio'); ?>
		<?php echo $form->textField($model,'r_fio',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_user_id'); ?>
		<?php echo $form->textField($model,'r_user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->