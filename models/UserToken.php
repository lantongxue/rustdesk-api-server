<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_token".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $my_id
 * @property string|null $uuid
 * @property string|null $token
 * @property string|null $expired
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class UserToken extends Basic
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_token}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['expired', 'created_at', 'updated_at'], 'safe'],
            [['my_id', 'uuid', 'token'], 'string', 'max' => 255],
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
            'my_id' => 'My ID',
            'uuid' => 'Uuid',
            'token' => 'Token',
            'expired' => 'Expired',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
