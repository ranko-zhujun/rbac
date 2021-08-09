<?php

namespace app\modules\backend\controllers;

use app\starter\controllers\BackendController;
use yii\web\Controller;

class UserController extends BackendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
