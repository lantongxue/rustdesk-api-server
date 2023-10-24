<?php

namespace app\controllers;

class SystemController extends ApiController
{
    public function actionHeartbeat()
    {
        return $this->asJson([
            'modified_at' => time(),
        ]);
    }

    public function actionSysinfo()
    {
        return 'SYSINFO_UPDATED';
    }
}