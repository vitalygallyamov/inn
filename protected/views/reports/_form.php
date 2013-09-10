<?php
/* @var $this ReportsController */
/* @var $model Reports */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reports-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'r_date'); ?>
		<?php echo $form->textField($model,'r_date'); ?>
		<?php echo $form->error($model,'r_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_notice'); ?>
		<?php echo $form->textField($model,'r_notice',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'r_notice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_customer'); ?>
		<?php echo $form->textField($model,'r_customer',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'r_customer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_purchase'); ?>
		<?php echo $form->textField($model,'r_purchase',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'r_purchase'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_winner'); ?>
		<?php echo $form->textField($model,'r_winner',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'r_winner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_inn'); ?>
		<?php echo $form->textField($model,'r_inn'); ?>
		<?php echo $form->error($model,'r_inn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_kpp'); ?>
		<?php echo $form->textField($model,'r_kpp'); ?>
		<?php echo $form->error($model,'r_kpp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_email'); ?>
		<?php echo $form->textField($model,'r_email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'r_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_phone'); ?>
		<?php echo $form->textField($model,'r_phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'r_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_nmc'); ?>
		<?php echo $form->textField($model,'r_nmc'); ?>
		<?php echo $form->error($model,'r_nmc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_provision'); ?>
		<?php echo $form->textField($model,'r_provision'); ?>
		<?php echo $form->error($model,'r_provision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_region'); ?>
		<?php echo $form->textField($model,'r_region',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'r_region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_address'); ?>
		<?php echo $form->textField($model,'r_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'r_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_fio'); ?>
		<?php echo $form->textField($model,'r_fio',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'r_fio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_user_id'); ?>
		<?php echo $form->textField($model,'r_user_id'); ?>
		<?php echo $form->error($model,'r_user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->