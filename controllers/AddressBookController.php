<?php

namespace app\controllers;


use app\models\Peer;
use Yii;

class AddressBookController extends ApiController
{
    public function actionPull()
    {
        $obj = $this->getUser();
        if($obj === null) {
            return $this->asJson(['error' => 'need login']);
        }

        $peer_list = Peer::find()->where(['user_id' => $obj->user_id])->all();

        $tags = [];
        $tag_colors = [];
        $peers = [];
        foreach ($peer_list as $peer) {
            $tag = json_decode($peer->tags, true);
            $tags[] = $tag['name'];
            $tag_colors[] = $tag['color'];
            $peers[] = [
                'id' => $peer->peer_id,
                'hash' => $peer->hash,
                'username' => $peer->username,
                'hostname' => $peer->hostname,
                'platform' => $peer->platform,
                'alias' => $peer->alias,
                'tags' => $tags,
            ];
        }

        return $this->asJson([
            'licensed_devices' => 0,
            'data' => [
                'tags' => $tags,
                'peers' => $peers,
                'tag_colors' => $tag_colors
            ],
        ]);
    }

    public function actionPush()
    {
        $request = Yii::$app->request;
        $data = $request->post('data');
        $data = json_decode($data, true);
    }
}