<?php
use wbraganca\fancytree\FancytreeWidget;
use yii\helpers\Url;
use yii\web\JsExpression;
?>
<pre><?php //echo print_r($data);die();?></pre>
<div class="">

	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<div class="box box-primary">
				<div class="box-header with-border">
				    <h3 class="box-title">Дерево</h3>
				    <div class="box-tools pull-right">
					<a href="<?= Url::toRoute('/menu/create') ?>" class="btn btn-box-tool"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
				<?php echo FancytreeWidget::widget([
    'options' => [
        'source' => $data,
        'extensions' => ['dnd'],
        'dnd' => [
            'preventVoidMoves' => true,
            'preventRecursiveMoves' => true,
            'autoExpandMs' => 400,
            'dragStart' => new JsExpression('function(node, data){
                    return true;
            }'),
            'dragEnter' => new JsExpression('function(node, data){
                    return true;
            }'),
            'dragDrop' => new JsExpression('function(node, data){
                console.log(data);
                    $.get("/menu/move", {item: data.otherNode.key.substr(1), 
                    action: data.hitMode, second: node.key.substr(1)}, function(){
                            data.otherNode.moveTo(node, data.hitMode);
                    });
            }'),
        ],
        'activate' => new JsExpression(
            'function(event, data){
                var title = data.node.title;
                var id = data.node.key.substr(1);
                $("#cat-info .box-header>h3").text(title);
				$.get("/menu/view-ajax", {id: id}, function(data){
					$("#cat-info .box-body").html(data);
				});   
        }'),
        
    ]
])?>

				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-ld-6">
			<div class="box box-primary" id="cat-info">
				<div class="box-header with-border">
					<h3 class="box-title">Инфо</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					
				</div>
			</div>
		</div>
	</div>
</div>

