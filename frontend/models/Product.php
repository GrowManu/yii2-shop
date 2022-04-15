<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property string|null $foto
 * @property int|null $category_id
 */
class Product extends ActiveRecord {

    /**
     * {@inheritdoc}
     */
//    public $status;
    
    public static function tableName() {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'price', 'status', 'text'], 'required'],
            [['category_id', 'status'], 'integer'],
            [['status', 'price'], 'integer'],
            ['name', 'string', 'max' => 500],
            ['text', 'string', 'max' => 5000],
            [['foto'], 'image', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getProducts() {
        return $this->hasMany(Category::class, ['id' => 'category_id']);
    }

    public function getSaveImage() {
        if($this->foto = UploadedFile::getInstance($this, 'foto')){
            $this->foto->saveAs(Yii::getAlias('@frontend') . '/web/images/' . $this->foto->name);
        }
        return;
        

        //return $this->hasMany(Category::class, ['id' => 'category_id']);
    }

    public function getCategory() {
        $model = Category::find()->with('products')->all();
        return ArrayHelper::map($model, 'id', 'name');
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'foto' => 'Foto',
            'category_id' => 'Category ID',
        ];
    }

}
