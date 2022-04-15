<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>
<div class="post">
    <tbody>
        <tr>
            <td><?= Html::img('/images/' . $model->foto, ['width' => 250]) ?></td>
            <td><?= $model->name ?></td>
            <?php
            //var_dump($model->foto);die;
            ?>
            <td><?= $model->price . '$'; ?></td>
            <td>
              <?= 
                                            //Html::a(, 'product/' . $key, ['class' => "btn btn-primary"]);
                                            Html::a('Подробнее', "/product/{$model->id}", ['class' => 'btn btn-primary']);
                                        ?>
            </td>
        </tr>
    </tbody>
</p>
</div>