<?php

namespace app\controllers;

use app\models\Authors;
use Yii;
use app\models\Books;
use yii\data\SqlDataProvider;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->isGuest) return $this->redirect('/login');

        $query = "SELECT `books`.`id` as 'id', `books`.`name` as 'book', CONCAT(`authors`.`first_name`, ' ', 
`authors`.`last_name`) as 'author' FROM `books` INNER JOIN `authors` ON `books`.`author_id` = `authors`.`id`";
        $count = Books::find()->count();

        $dataProvider = new SqlDataProvider(
            [
                'sql' => $query,
                'totalCount' => $count,
                'pagination' => ['pageSize' => 10],
            ]);

        $dataProvider->key = 'id';

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->isGuest) return $this->redirect('/login');

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->isGuest) return $this->redirect('/login');

        $model = new Books();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(["/admin/books"]);
        }

        $authors = Authors::find()
            ->select(['id', new Expression("CONCAT(`first_name`, ' ', `last_name`) as name")])
            ->asArray()
            ->all();

        $this->view->params['authors'] = $authors;

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->isGuest) return $this->redirect('/login');

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(["/admin/books"]);
        }

        $authors = Authors::find()
            ->select(['id', new Expression("CONCAT(`first_name`, ' ', `last_name`) as name")])
            ->asArray()
            ->all();

        $this->view->params['authors'] = $authors;

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if(\Yii::$app->user->isGuest) return $this->redirect('/login');

        $this->findModel($id)->delete();

        return $this->redirect(['admin/books']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
