<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;

class UserController extends ApiController
{
    public function actionIndex()
    {
        $obj = $this->getUser();
        return $this->asJson([
            'name' => $obj->user->name,
            'email' => $obj->user->email,
            'note' => $obj->user->note,
            'status' => $obj->user->status,
            'is_admin' => false,
        ]);
    }

    public function actionUsers()
    {
        $request = Yii::$app->request;

        $current = $request->get('current', 1);
        $pageSize = $request->get('pageSize', 10);
        //$accessible = $request->get('accessible', '');
        $status = $request->get('status', 1);

        $query = User::find()->where(['status' => $status]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $current
            ],
        ]);
        $models = $provider->getModels();
        $data = [];
        foreach ($models as $model) {
            $data[] = [
                'name' => $model->name,
                'email' => $model->email,
                'note' => $model->note,
                'status' => $model->status,
                'is_admin' => false,
            ];
        }
        return $this->asJson([
            'total' => $provider->getTotalCount(),
            'data' => $data
        ]);
    }
}