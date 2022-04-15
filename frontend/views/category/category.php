<?php

use yii\helpers\Url;
use yii\widgets\ListView;
$this->params['breadcrumbs'][] = $model->name;


?>
 <table class="table">
     <thead>
    <tr>
      <th scope="col">Фото</th>
      <th scope="col">Название</th>
       <th scope="col">Цена</th>
       <th scope="col">Подробности</th>
    </tr>
  </thead>
<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_post',
]);
?>
     </table>