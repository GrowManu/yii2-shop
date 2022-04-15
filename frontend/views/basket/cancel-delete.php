<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<form 
    method="post" 
    id="options-form<?= $key ?>" 
    action="<?= Url::to(['basket/delete-product']); ?>"
>
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

