<?php

namespace frontend\controllers;

use frontend\models\Product;
use frontend\models\ProductSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller {

    /**
     * @inheritDoc
     */
    
    public function behaviors() {
        return [     
                'access' => [
                'class' => AccessControl::class,
                'only' => [    
                    'index', 'create', 'update', 'delete'
                    ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'roles' => ['admin'],
                    ],
                ],
            ], 
        ];
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionCreate() {
        $model = new Product();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->getSaveImage();
                $model->foto = $model->foto->name;
                if($model->save()){
                     return $this->redirect(['view', 'id' => $model->id]);
                }   
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }
    
        public function actionUpdate($id) {
        $model = $this->findModel($id);
        if($model->foto){
            $foto = $model->foto;
        }
        if ($this->request->isPost && $model->load($this->request->post())) {
            
            if(isset($model->foto)){
                $model->getSaveImage();
                if(isset($model->foto)){
                    $model->foto = $model->foto->name;
                }else{
                    $model->foto = $foto;
                } 
            }
            //var_dump($model->status);die;
            if($model->save()){
                //var_dump($model);die;
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }
    


    public function actionIndex() {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProduct($id) {
        $model = Product::findOne($id);
        return $this->render('product', [
            'model' => $model,
                    ]);
    }
    
    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */


    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if($model->foto){
            unlink('../web/uploads/' . $model->foto);
        }
        $model->delete();
        return $this->redirect(['index']);
    }
    

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
