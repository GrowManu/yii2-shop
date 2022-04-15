<?php

use yii\helpers\Html;
use yii\web\View;
if(strlen($model->name) > 20){
    $short_name_product = mb_substr($model->name, 0, 20) . '..';
}
//$this->title = 'Все категории';
$this->params['breadcrumbs'][] = ['label' => $model->products[0]['name'], 'url' => ["/category/{$model->products[0]['id']}"]];
//$this->params['breadcrumbs'][] = $model->products[0]['name'];
$this->params['breadcrumbs'][] = $short_name_product;
//var_dump($model->products[0]['name']);
$this->registerJsFile(
        'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', [View::POS_HEAD]
);
?>

<h4 class="text-center"><?= $model->name ?></h4>
<hr>
<div class="row">
    <div class="col-sm-1 text-center">
        <h5>Цена </h5>
        <?=
        //var_dump($model);die;
        $model->price . '$';
        ?>
    </div>
    <div class="col-sm-4 text-center">
        <h5>Фото</h5>
        <?= Html::img("/images/{$model->foto}", ['height' => 300]); ?>
    </div>
    <div class="col-sm-4 text-center">
        <h5>Описание товара</h5>
        <?=
        //var_dump($model);die;
        $model->text;
        ?>
    </div>
    <div class="col-sm-3 text-center">

        <?php
        $session = Yii::$app->session;
        $session->open();
        ?>
        <h5>Заказ</h5>
        <div class="row">
            <div class="col">
                    <button id="b-minus"  class="btn btn-danger">
                        <i class="fa fa-shopping-cart"></i>
                        -
                    </button>
            </div>
             
            <div id="result" class="col">

                <?php
                //$s = $session->get('basket');
                if (isset($session->get('basket')['products'][$model->id]['count'])) {
                    $ses = $session->get('basket')['products'][$model->id]['count'];
                    echo $ses;
                } else {
                    $ses = 0;
                    echo '0';
                }
                //var_dump($session->get('basket')['products'][$model->id]['count']);die;
                ?>
            </div>
<?php
    $js = <<<JS
        $("#b-minus").click(function () {
            var value = $('#result').html();
            //alert(value);
            if(value != 0){
                $.ajax({
                    type: "POST",
                    url: "/basket/button",
                    data: {id:{$model->id},
                        minus:1},
                    success: function (mesg)
                    {
                    if(mesg == 0){
                        $('#b-minus').hide();
                            }
                        $('#result').html(mesg);
                    return false;
                        //alert('sdfsdf');
                    }
                });
            return false;
            }        
   }
        );
JS;
$this->registerJs($js, View::POS_LOAD);
?>
            <div class="col">
                
                    <button id="b-plus" class="btn btn-success">
                        <i class="fa fa-shopping-cart"></i>
                        +
                    </button>
            </div>
<?php
    $js = <<<JS
        $("#b-plus").click(function () {
            
                $.ajax({
                    type: "POST",
                    url: "/basket/button",
                    data: {id:{$model->id},
                        plus:1},
                    success: function (mesg)
                    {
                    $('#result').html(mesg);
                    //alert(mesg);
                    if(mesg == 1){
                        $('#b-minus').show();
                            }
                        
                    return false;
                        //alert('sdfsdf');
                    }
                });
            return false;
            
        }
        );
JS;
$this->registerJs($js, View::POS_LOAD);
?>

        </div> 
    </div>
</div>






