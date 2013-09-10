<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Пользователи'=>array('admin'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Создать пользователя</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>