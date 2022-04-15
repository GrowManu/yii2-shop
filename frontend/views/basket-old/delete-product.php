<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<form 
    method="post" 
    id="options-form<?= $key ?>" 
    action="<?= Url::to(['basket/cancel-delete']); ?>"
>
    <input type="hidden" name="key" value="<?= $key; ?>">
    <?=
    Html::hiddenInput(
            Yii::$app->request->csrfParam, 
            Yii::$app->request->csrfToken
    );
    ?>
    <button type="submit" class="btn btn-success">
        <i class="fa fa-shopping-cart"></i>
        Восстановить
    </button>
</form>