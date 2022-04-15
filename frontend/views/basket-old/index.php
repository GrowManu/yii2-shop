<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = 'test';
?>



<section>
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-9">
                <h1>Корзина</h1>
                <?php if (!empty($basket)): ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Наименование</th>
                            <th>Количество</th>
                            <th>Цена, руб.</th>
                            <th>Сумма, руб.</th>
                            <th></th>
                        </tr>
                        <?php foreach ($basket['products'] as $key => $item): ?>  
                        <tr>
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
                            <?php
                                Pjax::begin(
                                    [
                                        'enablePushState' => false,
                                        'formSelector' => '#options-form' . $key,
                                    ]
                                );
                            ?> 
                                <form method="post" id="options-form<?= $key ?>" action="<?= Url::to(['basket/delete-product']); ?>">
                                    <input type="hidden" name="key" value="<?= $key; ?>">
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
                                <?php Pjax::end(); ?> 
                            </td>
                        </tr><?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-right">Итого</td>
                            <td class="text-right"><?= $basket['amount']; ?></td>
                        </tr>
                    </table>
                <?php else: ?>
                    <p>Ваша корзина пуста</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

