<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
    <div class="post">
  <tbody>
    <tr>
      <td><?= $model->name ?></td>
      <td><?= Html::img('/uploads/' . $model->foto, ['width'=>150]) ?></td>
      <td><?= $model->price ?></td>
    </tr>
  </tbody>
</p>
</div>