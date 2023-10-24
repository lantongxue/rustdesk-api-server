<?php

namespace app\controllers;

use app\forms\Login;
use app\models\User;
use app\models\UserToken;
use Yii;

class LoginController extends ApiController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;

        $loginForm = new Login();
        if($loginForm->load($request->post()) && $loginForm->validate()) {

            $user = User::find()->where(['username' => $loginForm->username])->andWhere(['>', 'status', 0])->limit(1)->one();
            if($user === null) {
                return $this->asJson(['error' => 'user not exists']);
            }
            if(!Yii::$app->security->validatePassword($loginForm->password, $user->password)) {
                return $this->asJson(['error' => 'username or password error']);
            }

            $userToken = new UserToken();
            $userToken->user_id = $user->id;
            $userToken->my_id = $loginForm->id;
            $userToken->uuid = $loginForm->uuid;
            $userToken->token = sha1($user->username.time().$loginForm->uuid);
            if($loginForm->autoLogin) {
                $userToken->expired = date('Y-m-d H:i:s', strtotime('+100 year'));
            } else {
                $userToken->expired = date('Y-m-d H:i:s', strtotime('+2 day'));
            }
            $userToken->save();
            return $this->asJson([
                'access_token' => $userToken->token,
                'type' => 'access_token',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'note' => $user->note,
                    'status' => $user->status,
                    'is_admin' => false,
                ]
            ]);

        }
        return $this->asJson(['error' => $loginForm->getErrors()[0][0]]);
    }

    public function actionLogout()
    {
        $request = Yii::$app->request;

        $id = $request->post('id');
        $uuid = $request->post('uuid');

        if(empty($id)) {
            return $this->asJson(['error' => 'id not empty']);
        }

        if(empty($uuid)) {
            return $this->asJson(['error' => 'uuid not empty']);
        }

        $user = $this->getUser();
        $query = UserToken::find();
        if($user !== null) {
            $query->where(['user_id' => $user->user_id]);
        }
        $token = $query->andWhere(['my_id' => $id, 'uuid' => $uuid])->limit(1)->one();
        $token->expired = null;
        $token->save();

        return $this->asJson(['ok']);
    }

    public function actionOptions()
    {
        return $this->asJson([]);
    }
}