<?php
/* @var $this ReportsController */
/* @var $data Reports */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_date')); ?>:</b>
	<?php echo CHtml::encode($data->r_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_notice')); ?>:</b>
	<?php echo CHtml::encode($data->r_notice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_customer')); ?>:</b>
	<?php echo CHtml::encode($data->r_customer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_purchase')); ?>:</b>
	<?php echo CHtml::encode($data->r_purchase); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_winner')); ?>:</b>
	<?php echo CHtml::encode($data->r_winner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_inn')); ?>:</b>
	<?php echo CHtml::encode($data->r_inn); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('r_kpp')); ?>:</b>
	<?php echo CHtml::encode($data->r_kpp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_email')); ?>:</b>
	<?php echo CHtml::encode($data->r_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_phone')); ?>:</b>
	<?php echo CHtml::encode($data->r_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_nmc')); ?>:</b>
	<?php echo CHtml::encode($data->r_nmc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_provision')); ?>:</b>
	<?php echo CHtml::encode($data->r_provision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_region')); ?>:</b>
	<?php echo CHtml::encode($data->r_region); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_address')); ?>:</b>
	<?php echo CHtml::encode($data->r_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_fio')); ?>:</b>
	<?php echo CHtml::encode($data->r_fio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->r_user_id); ?>
	<br />

	*/ ?>

</div>