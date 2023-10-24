<?php

namespace app\controllers;

use app\models\Peer;
use Yii;
use yii\data\ActiveDataProvider;

class PeerController extends ApiController
{
    public function actionPeers()
    {
        $request = Yii::$app->request;

        $current = $request->get('current', 1);
        $pageSize = $request->get('pageSize', 10);
        //$accessible = $request->get('accessible', '');
        $status = $request->get('status', 1);

        $obj = $this->getUser();
        if($obj === null) {
            return $this->asJson(['error' => 'need login']);
        }

        $query = Peer::find()->where(['user_id' => $obj->user_id]);

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
                'id' => $model->peer_id,
                'info' => [
                    'username' => $model->username,
                    'os' => $model->platform,
                    'device_name' => $model->hostname,
                ],
                'status' => $status,
                'user' => [
                    'name' => $obj->user->name,
                    'email' => $obj->user->email,
                    'note' => $obj->user->note,
                    'status' => $obj->user->status,
                    'is_admin' => false,
                ],
                'user_name' => $model->username,
                'note' => $model->note,
            ];
        }
        return $this->asJson([
            'total' => $provider->getTotalCount(),
            'data' => $data
        ]);
    }
}