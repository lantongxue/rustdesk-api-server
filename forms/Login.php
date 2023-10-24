<?php

namespace app\forms;

use yii\base\Model;

class Login extends Model
{
    public $username;
    public $password;
    public $id;
    public $uuid;
    public $autoLogin;
    public $type;

    public function rules()
    {
        return [
            [['username', 'password', 'id', 'uuid', 'type'], 'required'],
            [['username', 'password', 'id', 'uuid', 'type'], 'trim'],
            ['autoLogin', 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => true],
            ['type', 'compare', 'compareValue' => 'account'],
        ];
    }
}