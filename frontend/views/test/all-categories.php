<?php

use yii\helpers\Html;
?>
<style> 
    .flip, .panel{
        padding: 5px;
        /*padding-right: 10px;*/
        text-align: left;
        /*background-color: #e5eecc;*/
        border: solid 1px #c3c3c3;
    }

    .panel {
        padding: 5px;
        display: none;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.flip').each(function(){
        $(".flip").click(function () {
            $(".panel").slideToggle("slow");
        });
            
        })
    });
</script>
<div class="row">
    <div class="col-sm-3"><div class="text-center">
            <h3><?= Html::encode('Категории') ?></h3>
            <ul class="list-group ">
                <?php foreach ($model as $value): ?>
                    <li class="list-group-item flip">
                        <a href="#"><?=$value->name?></a>
                    </li>
                    <li class="list-group-item panel">
                        <div>__Подкатегория 1.1</div>
                    </li>
                <?php endforeach; ?>
                    
            </ul>
        </div>
    </div>

</div>
<?php
//var_dump(\Yii::$app->authManager);die;?>