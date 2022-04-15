<?php

use frontend\models\Category;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'name',
            'price',
            //'foto',
            ['attribute' => 'category_id',
                'content' => function ($data) {
                    if ($data->category_id == $data->products[0]->id) {
                        return $data->products[0]->name;
                    }
                },
                'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'name')
            ],
            ['attribute' => 'status',
                'content' => function ($data) {
                //var_dump($data->status);die;
                    foreach (Yii::$app->params["statusProduct"] as $key => $value) {
                        if ($data->status == $key) {
                            return $value;
                        }
                    }
                },
                'filter' => Yii::$app->params["statusProduct"]
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, frontend\models\Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>


</div>
