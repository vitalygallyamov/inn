<?php
/* @var $this ReportsController */
/* @var $model Reports */

$this->breadcrumbs=array(
	'База'=>array('index'),
	'Управление',
);

// $this->menu=array(
// 	array('label'=>'List Reports', 'url'=>array('index')),
// 	array('label'=>'Create Reports', 'url'=>array('create')),
// );

// Yii::app()->clientScript->registerScript('search', "
// $('.search-button').click(function(){
// 	$('.search-form').toggle();
// 	return false;
// });
// $('.search-form form').submit(function(){
// 	$('#reports-grid').yiiGridView('update', {
// 		data: $(this).serialize()
// 	});
// 	return false;
// });
// ");
?>

<h1>Управление протоколами</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php echo CHtml::link('Загрузить', $this->createUrl('upload'));?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reports-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(            // display 'create_time' using an expression
            'name'=>'r_date',
            'value'=>'date("d.m.Y H:i", strtotime($data->r_date))',
        ),
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
		'r_fio',
		/*'r_user_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
