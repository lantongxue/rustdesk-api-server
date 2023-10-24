<?php

namespace app\controllers;


use app\models\Peer;
use app\models\Tags;
use Yii;

class AddressBookController extends ApiController
{
    public function actionPull()
    {
        $obj = $this->getUser();
        if($obj === null) {
            return $this->asJson(['error' => 'need login']);
        }

        $tag_list = Tags::find()->where(['user_id' => $obj->user_id])->all();
        $tags = [];
        $tag_colors = [];
        foreach ($tag_list as $tag) {
            $tags[] = $tag->tag;
            $tag_colors[$tag->tag] = intval($tag->color);
        }

        $peer_list = Peer::find()->where(['user_id' => $obj->user_id])->all();
        $peers = [];
        foreach ($peer_list as $peer) {
            $tag = json_decode($peer->tags, true);
            $peers[] = [
                'id' => $peer->peer_id,
                'hash' => $peer->hash,
                'username' => $peer->username,
                'hostname' => $peer->hostname,
                'platform' => $peer->platform,
                'alias' => $peer->alias,
                'tags' => $tag,
            ];
        }
        $data = json_encode([
            'tags' => $tags,
            'peers' => $peers,
            'tag_colors' => json_encode($tag_colors, JSON_UNESCAPED_UNICODE)
        ], JSON_UNESCAPED_UNICODE);
        return $this->asJson([
            'licensed_devices' => count($peer_list),
            'data' => $data,
        ]);
    }

    public function actionPush()
    {
        $request = Yii::$app->request;
        $data = $request->post('data');
        $data = json_decode($data, true);
        $tags = $data['tags'];
        $peers = $data['peers'];
        $tag_colors = json_decode($data['tag_colors'], true);

        $obj = $this->getUser();
        if($obj === null) {
            return $this->asJson(['error' => 'need login']);
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            Tags::deleteAll(['user_id' => $obj->user_id]);
            Peer::deleteAll(['user_id' => $obj->user_id]);

            $tag_rows = [];
            foreach ($tags as $tag) {
                $tag_rows[] = [
                    'user_id' => $obj->user_id,
                    'tag' => $tag,
                    'color' => $tag_colors[$tag] ?? '4280391411', // 4280391411 is default color code
                ];
            }
            Yii::$app->db->createCommand()->batchInsert(Tags::tableName(), ['user_id', 'tag', 'color'], $tag_rows)->execute();

            $peer_rows = [];
            foreach ($peers as $peer) {
                $peer_rows[] = [
                    'user_id' => $obj->user_id,
                    'peer_id' => $peer['id'],
                    'hash' => $peer['hash'],
                    'username' => $peer['username'],
                    'hostname' => $peer['hostname'],
                    'platform' => $peer['platform'],
                    'alias' => $peer['alias'],
                    'tags' => json_encode($peer['tags'], JSON_UNESCAPED_UNICODE),
                ];
            }
            Yii::$app->db->createCommand()->batchInsert(Peer::tableName(), ['user_id', 'peer_id', 'hash', 'username', 'hostname', 'platform', 'alias', 'tags'], $peer_rows)->execute();
            $transaction->commit();
        } catch (\Exception $exception) {
            $transaction->rollBack();
            return $this->asJson(['error' => $exception->getMessage()]);
        }
        return 'null'; // return '' string or null
    }
}