<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
 <h4>Заказать?</h4>
<form method="post" id="options-form<?=$id?>" action="<?= Url::to(['basket/add']); ?>">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="text" name="count" value="1"><br><br>
                    <?=
                    Html::hiddenInput(
                        Yii::$app->request->csrfParam,
                        Yii::$app->request->csrfToken
                    );
                    ?>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-shopping-cart"></i>
                        В корзину
                    </button>
                </form>


