<?php

namespace app\modules\backend\controllers;

use app\modules\backend\forms\FormUser;
use app\modules\backend\models\User;
use app\starter\controllers\BackendController;
use Yii;
use yii\web\Controller;

class UserController extends BackendController
{
    public function actionIndex()
    {
        $this->data['userlist'] = User::queryList(10);

        return $this->view('index');
    }

    public function actionEdit()
    {

        $model = new FormUser();
        $this->data['model'] = $model;

        $authManager = Yii::$app->authManager;
        $roles = $authManager->getRoles();
        $this->data['roles'] = $roles;

        return $this->view('edit');
    }

}
