<?php

namespace app\models;

use yii\db\ActiveRecord;

abstract class Basic extends ActiveRecord
{
    public function behaviors()
    {
        return [
            '' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'   => function(){return date('Y-m-d H:i:s',time());}
            ]
        ];
    }
}