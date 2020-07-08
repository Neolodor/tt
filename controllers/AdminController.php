<?php

namespace app\controllers;

use yii\data\SqlDataProvider;

class AdminController extends \yii\web\Controller
{
    /**
     * Admin default page render
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {

        if(\Yii::$app->user->isGuest) return $this->redirect('/login');
        return $this->render('index');
    }
}
