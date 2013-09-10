<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Пользователи'=>array('admin'),
	$model->fio=>array('view','id'=>$model->id),
	'Обновить',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Обновить данные пользователя - <?php echo $model->fio; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>