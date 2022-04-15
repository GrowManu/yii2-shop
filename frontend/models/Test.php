<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $title
 * @property int $parent_id
 */
class Test extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['title', 'parent_id'], 'required'],
            [['parent_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'parent_id' => 'Parent ID',
        ];
    }

    public function getCat() {
        $row = $this->find()->indexBy('id')->asArray()->all();
        return $row;
        $arr_cat = array();
        if (count($row) != 0) {
            for ($i = 1; $i <= count($row); $i++) {
                if (empty($arr_cat[$row[$i]['parent_id']])) {
                    $arr_cat[$row[$i]['parent_id']] = array();
                }
                $arr_cat[$row[$i]['parent_id']][] = $row;
            }
            //var_dump($arr_cat);die;
            return $arr_cat;
        }
    }

    public function map_tree($dataset) {
        $tree = array();
        foreach ($dataset as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $dataset[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    public function getMenuHtml($tree) {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }
        return $str;
    }
    
    public function catToTemplate($category){
//        var_dump($category);die;
		ob_start();
//                $alias = Yii::getAlias("@frontend") . "\\views\\test\\test2";
//		include $alias;
		include 'D:/wamp/www/yii2/frontend/views/test/test2.php';
		return ob_get_clean();
	}

}
