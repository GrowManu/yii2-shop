<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;
use Yii;
use \yii\web\Controller;

/**
 * Description of AdminController
 *
 * @author presence
 */
class AdminController extends Controller{
    
    public function actionCreateRoles()
    {
        $auth = Yii::$app->authManager;

        // добавляем роль "user"
        $user = $auth->createRole('user');
        $auth->add($user);

        // добавляем роль "admin"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);
   }
}
