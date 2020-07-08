<?php

namespace app\controllers;

use app\models\Numbers;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;

class ApiController extends \yii\rest\ActiveController
{
    public $modelClass = "app\models\Numbers";

    public function actions(){

        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['index']);
        return $actions;
    }

    protected function verbs()
    {
        return [
            'generate' => ['POST'],
            'login' => ['GET'],
            'retrieve' => ['GET']
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => ['login']
        ];

        return $behaviors;
    }

    /**
     * Get auth token
     *
     * @return \yii\web\Response
     */
    public function actionLogin()
    {
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();
        $token = $jwt->getBuilder()
            ->issuedBy('http://example.com')
            ->permittedFor('http://example.org')
            ->identifiedBy('4f1g23a12aa', true)
            ->issuedAt($time)
            ->expiresAt($time + 3600)
            ->withClaim('uid', 100)
            ->getToken($signer, $key);

        return $this->asJson([
            'token' => (string)$token,
        ]);
    }

    /**
     * Generate random number
     *
     * @return \yii\web\Response
     */
    public function actionGenerate()
    {
        $value = rand();
        while (Numbers::findOne(['number' => $value]) !== null)
        {
            $value = rand();
        }

        $model = new Numbers();
        $model->number = $value;
        $model->save();

        return $this->asJson(['id' => $model->id]);
    }

    /**
     * Retrieve previously generated number.
     *
     * @param int $id               Operation ID
     * @return \yii\web\Response
     */
    public function actionRetrieve($id)
    {
        $number = Numbers::find()
            ->select('number')
            ->where(['id' => $id])
            ->one();

        if(!is_null($number)) $number = $number['number'];
        return $this->asJson(['number' => $number]);
    }
}
