<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peer".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $peer_id
 * @property string|null $hash
 * @property string|null $username
 * @property string|null $hostname
 * @property string|null $platform
 * @property string|null $alias
 * @property string|null $tags
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Peer extends Basic
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'peer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['peer_id', 'hash', 'username', 'hostname', 'platform', 'alias', 'tags'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'peer_id' => 'Peer ID',
            'hash' => 'Hash',
            'username' => 'Username',
            'hostname' => 'Hostname',
            'platform' => 'Platform',
            'alias' => 'Alias',
            'tags' => 'Tags',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
