<?php

use yii\helpers\Html;
use yii\imagine\Image;
?>

<?php

foreach ($model as $value) {
    //var_dump($value->products['status']);die;
    //if ($value->products['status'] === 1) {
        $img = Yii::getAlias('@frontend/web/images/' . $value->foto);
        $img_new = Yii::getAlias('@frontend/web/images/test/' . $value->foto);
        $image = Image::getImagine()->open($img);
        Image::resize($img, 150, 150)
                ->save($img_new, ['quality' => 100]);
        //$image = Yii::getAlias('@frontend/web/images/1.jpg');
 
// Обрежет по ширине на 600px, по высоте пропорционально
//Image::resize($image, 600, 600)
//	->save(Yii::getAlias('@frontend/web/images/test/1.jpg'), ['quality' => 100]);
        //echo Html::img('../web/images/test/1.jpg');
                                //echo Html::img('/images/' . $value->products['foto'], ['width' => 200]);

    //}
}