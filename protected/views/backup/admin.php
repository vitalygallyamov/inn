<?php
/* @var $this BackupController */
/* @var $model Backup */

$this->breadcrumbs=array(
	'Откаты'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Очистить базу', 'url'=>array('destroy'), 'linkOptions'=>array('confirm'=>'Вы уверены, что хотите безвозвратно очистить базу?')),
	//array('label'=>'Create Backup', 'url'=>array('create')),
);

?>

<h1>Управление откатами</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'backup-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
			'name' => 'time', 
			'value'=>'date("d.m.Y H:i", strtotime($data->time))',
		),
		//'user_id',
		array(
			'class'=>'CButtonColumn',
			'template' => '{back}',
			'header'=>'Действие',
			'buttons' => array(
				'back' => array(
					'label' => 'Откатить',
					'visible' => '$data->isLastID($data->id)',
					'url' => function($data, $row){
						return $this->createUrl('back', array('id' => $data->id));
					},
					'options'=>array('confirm'=>'Вы уверены?'),
				)
			)
		),
	),
)); ?>
