<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\CategorySearch;
use frontend\models\Product;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
//use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return [
                //parent::behaviors(), 
//                [
//                    'verbs' => [
//                        'class' => VerbFilter::className(),
//                        'actions' => [
//                            'delete' => ['POST'],
//                        ],
//                    ],
//                ],
                'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'login', 'logout', 'all-categories', 'category', 
                    'index', 'create', 'update', 'delete'
                    ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'all-categories', 'category'],
                        'roles' => ['user', 'admin'],
                    ],
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
     * Lists all Category models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionTest() {
        $model = Product::find()->where(['status'=>1])->all();
        return $this->render('test', [
                    'model' => $model
        ]);
    }
    

    public function actionAllCategories() {
        $model = Category::find()->with('products')->all();
        $model2 = Product::find()->where(['status'=>1])->all();
        $model3 = Product::find()->where(['status'=>0])->all();
//var_dump($model[0]->products->foto);die;
        return $this->render('all-categories', [
                    'model' => $model,
                    'model2' => $model2,
                    'model3' => $model3
        ]);
    }

    public function actionCategory($id) {
        $model = Category::find()->where(['id' => $id])->one();
        $query = Product::find()->with('products')->where(['category_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        return $this->render('category', [
                    'dataProvider' => $dataProvider,
                    'model' => $model
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate() {
        $model = new Category();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Category::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
