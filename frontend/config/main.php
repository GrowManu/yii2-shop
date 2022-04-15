<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
   'defaultRoute' => 'category/all-categories', 
//    'layout' => '@frontend/views/layouts/main.php',
    //'layout' => '@frontend/views/product/main.php',
//    'controllerMap' => [
//        'migrate-rbac' => [
//            'class' => 'yii\console\controllers\MigrateController',
//            'migrationPath' => '@yii/rbac/migrations',
//            'migrationTable' => 'migration_rbac',
//        ],
//    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//                '' => 'site/index',
//                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
//            ],
//        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      //'enableStrictParsing' => false,
      'rules' => [
          //'web/uploads/\w+' => '',
          //'category/<:id>' => 'category/category',
          //'menu/view-ajax<id:\d+>' => 'menu/view-ajax',
           'product/<id:\d+>'    => 'product/product',
          '<controller:\w+>/<id:\d+>'    => '<controller>/category',
           'category/<id:\d+>'    => 'category/category',
          '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
      ],
      ],
     
    ],
    'params' => $params,
];
