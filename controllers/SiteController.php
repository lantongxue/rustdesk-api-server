<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return 'Welcome to use rustdesk api server';
    }

    public function actionError()
    {
        $request = Yii::$app->request;

        $path = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'api.txt';
        
        $contents = $request->getAbsoluteUrl() . "\r\n".
                    '$_GET: ' . print_r($request->get(), true).
                    '$_POST:' . print_r($request->post(), true);
        file_put_contents($path, $contents, FILE_APPEND);
        return $this->asJson(['error' => Yii::$app->errorHandler->exception->getMessage()]);
    }
}