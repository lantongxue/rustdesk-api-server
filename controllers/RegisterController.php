<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;

class RegisterController extends Controller
{
    public function actionDo()
    {
        $request = Yii::$app->request;

        $username = $request->get('username');
        $password = $request->get('password');
        $name = $request->get('name');
        $email = $request->get('email', '');

        if(empty($username)) {
            return $this->asJson(['error' => 'username not empty']);
        }

        if(empty($password)) {
            return $this->asJson(['error' => 'password not empty']);
        }

        if(empty($name)) {
            $name = $username;
        }

        $exists = User::find()->where(['username' => $username])->limit(1)->exists();
        if($exists) {
            return $this->asJson(['error' => $username.' used']);
        }

        $user = new User();
        $user->username = $username;
        $user->password = Yii::$app->security->generatePasswordHash($password);
        $user->name = $name;
        $user->email = $email;
        $user->note = '';
        $user->status = 1;
        return $user->save() ? $this->asJson(['ok']) : $this->asJson(['error' => $user->getErrors()[0][0]]);
    }
}