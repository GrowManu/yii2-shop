<?php

use yii\helpers\Html;
use yii\web\View;

$this->params['breadcrumbs'][] = 'Корзина';
$this->registerJsFile(
        'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js',
        [View::POS_HEAD]
        );
?>
<div class="container text-center">
    <div class="row">
        <div class="col-sm-9">
            <h1 id="h1-1">Корзина</h1>
            <?php if (!empty($basket)): ?>
                <table id="table-1" class="table table-bordered">
                    <tr>
                        <th>Наименование</th>
                        <th>Количество</th>
                        <th>Цена, $.</th>
                        <th>Сумма, $.</th>
                        <th>Удалить?</th>
                        <th>Подробнее</th>
                    </tr>
                    <?php foreach ($basket['products'] as $key => $item): ?>  
                        <tr id="tr-<?= $key ?>">
                            <td>
                                <?= $item['name']; ?>
                            </td>
                            <td class="text-right">
                                <?= $item['count']; ?>
                            </td>
                            <td class="text-right">
                                <?= $item['price']; ?>
                            </td>
                            <td class="text-right"><?= $item['price'] * $item['count']; ?></td>
                            <td class="text-right">
                                <form id="f-<?= $key ?>" >
                                    <?=
                                    Html::hiddenInput(
                                            Yii::$app->request->csrfParam, Yii::$app->request->csrfToken
                                    );
                                    ?>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-shopping-cart"></i>
                                        Удалить
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                        <?= 
                                            //Html::a(, 'product/' . $key, ['class' => "btn btn-primary"]);
                                            Html::a('Подробнее', "/product/{$key}", ['class' => 'btn btn-primary']);
                                        ?>
                        </td>    
                        </tr>
                        
<?php
    $js = <<<JS
        $("#f-{$key}").submit(function () {
                $.ajax({
                    type: "POST",
                    url: "/basket/delete2",
                    data: {id:{$key}},
                    success: function (mesg)
                    {
                        $('#tr-{$key}').html('');
                        $('#suma').html(mesg);
                        if(mesg == ''){
                            $('#table-1').remove();
                            $('#h1-1').html('Корзина пуста');
                        }
                    }
                });
            return false;
            }
        );
JS;
$this->registerJs($js, View::POS_LOAD);
?>    
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="text-center h2">Итого</td>
                        <td id="suma" class="text-center h1"><?= $basket['amount']; ?></td>
                        <td colspan="2" class="text-center h2">
                            <button id="clear-basket" type="submit" class="btn btn-dark">
                                        <i class="fa fa-shopping-cart"></i>
                                        Очистить корзину
                                    </button>
                        </td>
                        
                        
                    </tr>
                </table>
            <?php else: ?>
                <p>Ваша корзина пуста</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
    $js = <<<JS
        $("#clear-basket").click(function () {
                $.ajax({
                    type: "POST",
                    url: "/basket/delete-session",
                    success: function (mesg){
                        return false;
                    }
                });
            }        
        );
JS;
$this->registerJs($js, View::POS_LOAD);
?>

