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

<?php echo CHtml::link('Загрузить файл', $this->createUrl('upload'));?>
<br>

<?
	$u = Users::model()->findByPk(Yii::app()->user->id);

	$count_winners = 0;
	foreach ($u->winners as $value) {
		$count_winners += count($value->protocols);
	}

	$count_potantials = 0;
	foreach ($u->potantials as $value) {
		$count_potantials += count($value->protocols);
	}
?>

<div class="action_buttons">
	<?php echo CHtml::link('Показать скрытые', $this->createUrl('admin', array('hidden' => true)));?>
	<?php echo CHtml::link('Победители'." (".$count_winners.")", $this->createUrl('admin', array('winners' => true)));?>
	<?php echo CHtml::link('Потенциальные клиенты'." (".$count_potantials.")", $this->createUrl('admin', array('potantials' => true)));?>
</div>

<div id="comment-form" style="display: none;">
	<? $this->renderPartial('/comments/_form', array('model' => $comment));?>
</div>

<?php $this->renderPartial('_grid', array('model'=>$model)); ?>

<?php

//register fancybox
$cs = Yii::app()->clientScript;
$cs->registerScriptFile('/js/fancybox/jquery.fancybox.pack.js', CClientScript::POS_HEAD);

?>