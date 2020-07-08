<?php

namespace app\controllers;

use app\models\Books;
use Yii;
use app\models\Reviews;
use yii\web\Controller;

/**
 * ReviewController implements the CRUD actions for Reviews model.
 */
class ReviewController extends Controller
{

    /**
     * Creates a new Reviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->isGuest) return $this->redirect('/login');

        $model = new Reviews();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(["/admin/books"]);
        }

        $books = Books::find()
            ->select(['id', 'name'])
            ->asArray()
            ->all();

        $this->view->params['books'] = $books;
        $this->view->params['author'] = 'Admin';

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
