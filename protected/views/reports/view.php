<?php
/* @var $this ReportsController */
/* @var $model Reports */

$this->breadcrumbs=array(
	'Reports'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reports', 'url'=>array('index')),
	array('label'=>'Create Reports', 'url'=>array('create')),
	array('label'=>'Update Reports', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reports', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reports', 'url'=>array('admin')),
);
?>

<h1>View Reports #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'r_date',
		'r_notice',
		'r_customer',
		'r_purchase',
		'r_winner',
		'r_inn',
		'r_kpp',
		'r_email',
		'r_phone',
		'r_nmc',
		'r_provision',
		'r_region',
		'r_address',
		'r_fio'
	),
)); ?>
