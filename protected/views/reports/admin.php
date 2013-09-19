<?php
/* @var $this ReportsController */
/* @var $model Reports */

$this->breadcrumbs=array(
	'Протоколы'=>array('admin'),
	'Управление',
);

/*$this->menu=array(
	array('label'=>'List Reports', 'url'=>array('index')),
	array('label'=>'Create Reports', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reports-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h1>Управление протоколами</h1>

<?php //$r = ""; if(!empty($r)) echo strlen(trim($r));?>

<?php echo CHtml::link('Загрузить', $this->createUrl('upload'));?>

<div id="comment-form" style="display: none;">
	<? $this->renderPartial('/comments/_form', array('model' => $comment));?>
</div>

<?php $this->renderPartial('_grid', array('model'=>$model)); ?>
