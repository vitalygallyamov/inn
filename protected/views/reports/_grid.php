<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reports-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	//'ajaxType' => 'GET',
	'rowHtmlOptionsExpression' => 'array("data-company" => $data->company->c_inn)',
	'columns'=>array(
		//'id',
		array(            // display 'create_time' using an expression
            'name'=>'r_date',
            'value'=>'date("d.m.Y H:i", strtotime($data->r_date))',
            'filter' => CHtml::activeDropDownList($model, 'r_date', Reports::dates())
        ),
		'r_notice',
		'r_customer',
		'r_purchase',
		array(
            'header'=>'Победитель',
            'value'=>'$data->company->c_name',
        ),
		'r_inn',
		array(
            'header'=>'КПП',
            'value'=>'$data->company->c_kpp',
        ),
        array(
            'header'=>'Email',
            'value'=>'$data->company->c_email',
        ),
        array(
            'header'=>'Телефон',
            'value'=>'$data->company->c_phone',
        ),
		array(
			'name' => 'r_nmc',
			'value' => 'number_format($data->r_nmc, 2, ".", ",")'
		),
		array(
			'name' => 'r_provision',
			'value' => 'number_format($data->r_provision, 2, ".", ",")',
			'filter' => CHtml::activeDropDownList($model, 'r_provision', Reports::priceBounds())
		),
		array(
			'name' => 'r_region',
			'filter' => CHtml::activeDropDownList($model, 'r_region', Reports::getRegions())
		),
		array(
			'class'=>'CButtonColumn',
			'template' => '{add_comment} {all_comments}',
			'header'=>'Коментарии',
			'buttons' => array(
				'add_comment' => array( 
					'label' => 'Добавить',
					'click' => 'js:function(e){
						e.preventDefault();
						var com_id = $(this).closest("tr").data("company");
						jQuery("#comment-form").find("#Comments_text").val("");
						jQuery("#comment-form").find("#Comments_company_id").val(com_id);
						$.fancybox.open(jQuery("#comment-form"));
					}'
				),
				'all_comments' => array( 
					'label' => 'Посмотреть',
					'visible' => '$data->company->comments',
					'click' => 'js:function(e){
						e.preventDefault();
						var com_id = $(this).closest("tr").data("company");
						$.ajax({
							url : "/comments/index",
							type: "GET",
							data: {company_id : com_id},
							success: function(data){
								$.fancybox.open(data);
							}
						});
						//jQuery("#comment-form").find("#Comments_company_id").val(com_id);
						//$.fancybox.open(jQuery("#comment-form"));
					}'
				),
			)
			
		),
		// 'r_status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>