<?php

namespace app\modules\backend\controllers;

use app\starter\controllers\BackendController;
use app\starter\rbac\rule\AuthorRule;
use Yii;
use yii\web\Controller;

class PermissionController extends BackendController
{
    public function actionIndex()
    {
        $authManager = Yii::$app->authManager;

        $permissions = $authManager->getPermissions();
        $this->data['permissions'] = $permissions;

        return $this->view('index');
    }

    public function actionEdit(){

    }

    public function actionSave(){

    }

}
