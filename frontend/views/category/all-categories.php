<?php

use yii\helpers\Html;

//$this->title = 'Все категории';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-3"><div class="text-center">
            <h3><?= Html::encode('Категории') ?></h3>
            <ul class="list-group ">
                <?php foreach ($model as $value): ?>
                    <li class="list-group-item "><?=
                        Html::a($value->name, "/category/{$value->id}", ['class' => 'btn btn-link'])
                        ?>
                    </li>
                <?php endforeach; ?>
                    
            </ul>
        </div>
    </div>
    <div class="col-sm-9">
        <ul class="list-group">
            <li class="list-group-item ">
                <div class="container text-center">
                    <h2>Популярные товары</h2>
                    <div class="row">
                        <?php foreach ($model2 as $key => $value): ?>
                        <?php
                                        if (strlen($value->name) > 40) {
                                            $short_name_product = mb_substr($value->name, 0, 40) . '..';
                                        } else {
                                            $short_name_product = $value->name;
                                        }
                                        ?>
                            <div class="col">
                                <div >
                                    <?php
                                    echo Html::img('/images/' . $value->foto, ['height' => 200,
                                        //'class' => "card-img-top",
                                    ]);
                                    ?>
                                    <div class="card-body">
                                        <p class="small"><?= $short_name_product ?></p>
                                        <?=
                                        //Html::a(, 'product/' . $key, ['class' => "btn btn-primary"]);
                                        Html::a('Подробнее', "/product/{$value->id}", ['class' => 'card-img-top btn btn-primary']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>


            </li>
            <li class="list-group-item">

                <div class="container text-center">
                    <h2>Новые товары</h2>
                    <div class="row">
                        <?php foreach ($model3 as $value): ?>
                            <div class="col">
                                <div class="" >
                                    <?php
                                    echo Html::img('/images/' . $value->foto, ['height' => 200,
                                        //'class' => "card-img-top",
                                    ]);
                                    ?>
                                    <div class="card-body">
                                        
                                        <p class="small"><?= $short_name_product ?></p>
                                        <?=
                                        //Html::a(, 'product/' . $key, ['class' => "btn btn-primary"]);
                                        Html::a('Подробнее', "/product/{$value->id}", ['class' => 'card-img-top btn btn-primary']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </li>
        </ul>
    </div>
</div>

<?php
//var_dump(\Yii::$app->authManager);die;?>