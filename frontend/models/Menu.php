<?php

namespace frontend\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $tree
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $name
 * @property string $url
 * @property string|null $text
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $sub;
    
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['sub', 'lft', 'rgt', 'depth', 'tree'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 50],
            [['text'], 'string', 'max' => 1000],
            [['lft', 'rgt', 'depth', 'tree'], 'safe'],
        ];
    }
    
    public static function tableName()
    {
        return 'menu';
    }
    
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
            ],
            'htmlTree' => [
                'class' => \wokster\treebehavior\NestedSetsTreeBehavior::className(),
            ]
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => 'Tree',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'name' => 'Name',
            'url' => 'Url',
            'text' => 'Text',
        ];
    }
}
