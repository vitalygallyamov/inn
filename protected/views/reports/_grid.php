<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reports-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
	'template' => '{pager}{summary}{items}{summary}{pager}',
	//'ajaxType' => 'GET',
	'rowHtmlOptionsExpression' => 'array("data-company" => $data->company->c_inn, "data-report" => $data->id)',
	'columns'=>array(
		//'id',
		/*array(            // display 'create_time' using an expression
            'name'=>'r_date',
            'value'=>'date("d.m.Y H:i", strtotime($data->r_date))',
            //'filter' => CHtml::activeDropDownList($model, 'r_date', Reports::dates())
        ),*/
		array(
			'class'=>'CButtonColumn',
			'template' => '{to_hide} {to_show} {winners} {cancel_winners} {add_potantials} {remove_potantials}',
			'header'=>'Действия',
			'buttons' => array(
				'to_hide' => array( 
					'label' => 'Скрыть',
					'visible' => '!$data->company->c_status && !$data->hasWinner()',
					'click' => 'js:function(e){
						e.preventDefault();
						if(confirm("Вы уверены?")){
							var com_id = $(this).closest("tr").data("company");
							$.ajax({
								url: "/companies/changeCompany",
								data: {id: com_id, hide: 1},
								type: "GET",
								success: function(){
									jQuery("#reports-grid").yiiGridView("update");
								}
							});
						}
					}'
				),
				'to_show' => array( 
					'label' => 'Показать',
					'visible' => '$data->company->c_status',
					'click' => 'js:function(e){
						e.preventDefault();
						if(confirm("Вы уверены?")){
							var com_id = $(this).closest("tr").data("company");
							$.ajax({
								url: "/companies/changeCompany",
								data: {id: com_id, hide: 0},
								type: "GET",
								success: function(){
									jQuery("#reports-grid").yiiGridView("update");
								}
							});
						}
					}'
				),
				'winners' => array( 
					'label' => 'Победитель',
					'visible' => '!$data->hasWinner()',
					'click' => 'js:function(e){
						e.preventDefault();
						if(confirm("Добавить в победители?")){
							var company_id = $(this).closest("tr").data("company");
							$.ajax({
								url: "/reports/changeWinners",
								data: {company_id: company_id},
								type: "GET",
								success: function(){
									jQuery("#reports-grid").yiiGridView("update");
								}
							});
						}
					}'
				),
				'cancel_winners' => array( 
					'label' => 'Убрать из подедителей',
					'visible' => '$data->hasWinner()',
					'click' => 'js:function(e){
						e.preventDefault();
						if(confirm("Удалить из победителей?")){
							var company_id = $(this).closest("tr").data("company");
							$.ajax({
								url: "/reports/changeWinners",
								data: {company_id: company_id, action: "delete"},
								type: "GET",
								success: function(){
									jQuery("#reports-grid").yiiGridView("update");
								}
							});
						}
					}'
				),
				'add_potantials' => array( 
					'label' => 'Потенциальный клиент',
					'visible' => '!$data->hasPotantial()',
					'click' => 'js:function(e){
						e.preventDefault();
						if(confirm("Добавить в потенциальные клиенты?")){
							var company_id = $(this).closest("tr").data("company");
							$.ajax({
								url: "/reports/changePotantials",
								data: {company_id: company_id},
								type: "GET",
								success: function(){
									jQuery("#reports-grid").yiiGridView("update");
								}
							});
						}
					}'
				),
				'remove_potantials' => array( 
					'label' => 'Убрать из потенцальных клиентов',
					'visible' => '$data->hasPotantial()',
					'click' => 'js:function(e){
						e.preventDefault();
						if(confirm("Удалить из потенциальных клиентов?")){
							var company_id = $(this).closest("tr").data("company");
							$.ajax({
								url: "/reports/changePotantials",
								data: {company_id: company_id, action: "delete"},
								type: "GET",
								success: function(){
									jQuery("#reports-grid").yiiGridView("update");
								}
							});
						}
					}'
				)
				/*'add_to_winners' => array( 
					'label' => 'Победитель',
					'click' => 'js:function(e){}'
				),*/
			)
			
		),
 		array(
            'name' => 'r_date',
            'value'=>'date("d.m.Y H:i", strtotime($data->r_date))',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model, 
                'attribute'=>'r_date', 
                'language' => 'ru',
                //'i18nScriptFile' => 'jquery.ui.datepicker-ru.js', //(#2)
                'htmlOptions' => array(
                    'id' => 'dp_r_date',
                    'size' => '10',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'dateFormat' => 'dd.mm.yy',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    /*'showButtonPanel' => true,
                    'gotoCurrent' => true*/
                )
            ), 
            true), // (#4)
        ),
		'r_notice',
		'r_customer',
		'r_purchase',
		array(
            'header'=>'Победитель',
            'value'=>'$data->company->c_name',
            'filter' => CHtml::activeTextField($model, 'c_name')
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
            'header'=>'Выиграно',
            'sortable' => true,
            'name' => 'company.c_count',
            'value'=>'$data->company->c_count',
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
)); 

// (#5)
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    jQuery('#dp_r_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ru'],[]));
}
");
?>