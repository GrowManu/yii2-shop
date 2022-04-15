<?php

namespace frontend\controllers;

use frontend\models\Basket;
use frontend\models\Product;
use Yii;
use yii\web\Controller;

class BasketController extends Controller {

    public function actionIndex() {
        $basket = (new Basket())->getBasket();
        $session = Yii::$app->session;
        $session->open();
        if (isset($session->get('basket')['amount'])) {
            if($session->get('basket')['amount'] == 0){
                $basket = [];
            }
        } 
        //var_dump($session->get('basket')['amount']);die;
        return $this->render('index', ['basket' => $basket]);
    }

    public function actionAdd() {
        $basket = new Basket();
        $data = Yii::$app->request->post();
        $basket->addToBasket($data['id'], $data['count']);
        return $this->renderAjax('add', ['id' => $data['id']]);
    }

    public function actionButton() {
        $basket = new Basket();
        $data = Yii::$app->request->post();
        //var_dump($data);die;
        $model = Product::findOne($data['id']);
        $session = Yii::$app->session;
        $session->open();
        
            if (isset($data['minus'])) {
                $basket->addToBasket($data['id'], -1);
                return $session->get('basket')['products'][$model->id]['count'];
            }
            if (isset($data['plus'])) {
                $basket->addToBasket($data['id']);
                return $session->get('basket')['products'][$model->id]['count'];
            }
        
    }

    public function actionTest() {
        //какие-то действия 
//        $data = Yii::$app->request->post();
        return $this->render('test');
        //return true;
    }

    public function actionCancelDelete() {
        $data = Yii::$app->request->post();
//        var_dump($data);die;
        return $this->renderAjax('cancel-delete', ['key' => $data['key']]);
    }

    public function actionDelete2() {
        $data = Yii::$app->request->post();

        $basket = new Basket();
        $basket->removeFromBasket($data['id']);
        $session = Yii::$app->session;
        //var_dump();
        if (!empty($_SESSION['basket']['amount'])) {
            return $session->get('basket')['amount'];
        }
        return '';
//        return $session->get('basket')['amount'];
    }

    public function actionDelete() {
        $data = Yii::$app->request->post();
        //var_dump($data);die;
        $basket = new Basket();
        $basket->removeFromBasket($data['id']);
        return $this->renderAjax('delete', ['id' => $data['id']]);
    }

    public function actionDeleteSession() {
        $session = Yii::$app->session;
        $session->destroy();
        return $this->redirect('/basket/index');
    }

}
