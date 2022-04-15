<?php

namespace frontend\controllers;

use frontend\models\Basket;
use Yii;
use yii\web\Controller;

class BasketController extends Controller {
    
    public function actionIndex() {
        $basket = (new Basket())->getBasket();
        return $this->render('index', ['basket' => $basket]);
    }

    public function actionAdd() {
        $basket = new Basket();
        $data = Yii::$app->request->post();
        $basket->addToBasket($data['id'], $data['count']);
        return $this->renderAjax('add', ['id' => $data['id']]);
    }

    public function actionCancelDelete() {
        $data = Yii::$app->request->post();
//        var_dump($data);die;
        return $this->renderAjax('cancel-delete',['key' => $data['key']]);
    }
    
    public function actionDeleteProduct() {
//        $basket = new Basket();
        $data = Yii::$app->request->post();
//        $basket->addToBasket($data['id'], $data['count']);
//        return $this->renderAjax('add', ['id' => $data['id']]);
        return $this->renderAjax('delete-product',['key' => $data['key']]);
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
