<?php

namespace app\modules\backend\controllers;

use app\starter\controllers\BackendController;
use yii\web\Controller;

class RoleController extends BackendController
{
    public function actionIndex()
    {
        $authManager = Yii::$app->authManager;

        $permissions = $authManager->getPermissions();
        $this->data['permissions'] = $permissions;

        return $this->view('index');
    }

}
