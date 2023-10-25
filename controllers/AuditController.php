<?php

namespace app\controllers;

class AuditController extends ApiController
{
    public function actionConn()
    {
        /* data struct
        connect device
        $_POST:Array
        (
            [action] => new
            [conn_id] => 1498
            [id] => xxxxxxxx
            [ip] => 1xx.xx.xxx.xxx
            [session_id] => 0
            [uuid] => xxxxxxxx
        )
        close device
        $_POST:Array
        (
            [action] => close
            [conn_id] => 1500
            [id] => xxxxxxxx
            [session_id] => 0
            [uuid] => xxxxxxxx
        )
        */
        return '';
    }
}