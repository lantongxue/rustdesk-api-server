<?php

namespace app\controllers;

use app\models\UserToken;
use yii\web\Controller;

abstract class ApiController extends Controller
{
    protected function getUser()
    {
        $token_raw = \Yii::$app->request->headers->get('Authorization');
        if(empty($token_raw)) {
            return null;
        }
        $token_arr = explode(' ', $token_raw);
        if(count($token_arr) != 2) {
            return null;
        }
        $token = $token_arr[1];
        $obj = UserToken::find()->with('user')->where(['token' => $token])->andWhere(['!=', 'expired', null])->limit(1)->one();
        if($obj !== null && strtotime($obj->expired) < time()) {
            return null;
        }
        return $obj;
    }
}