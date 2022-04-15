<?php

$session = Yii::$app->session;
$session->open();
?>

<?php

$s = $session->get('basket');
if (isset($session->get('basket')['products'][$model->id]['count'])) {
    return $session->get('basket')['products'][$model->id]['count'];
} else {
    return '0';
}
?>
            