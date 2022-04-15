<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<h4>Отменить заказ?</h4>
        <form method="post" id="options-form<?=$id?>" action="<?= Url::to(['basket/delete']); ?>">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    
                    <?=
                    Html::hiddenInput(
                        Yii::$app->request->csrfParam,
                        Yii::$app->request->csrfToken
                    );
                    ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-shopping-cart"></i>
                        Удалить
                    </button>
                </form>

