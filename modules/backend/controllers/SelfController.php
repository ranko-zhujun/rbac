<?php

namespace app\modules\backend\controllers;

use app\modules\backend\forms\FormUser;
use app\modules\backend\models\User;
use app\starter\controllers\BackendController;
use Yii;
use yii\base\BaseObject;

class SelfController extends BackendController
{

    public function actionIndex()
    {
        $model = new FormUser();
        $userId = \Yii::$app->user->id;
        $object = User::findOne($userId);
        $model->setAttributes($object->getAttributes(),false);
        $model->setAttribute('password_hash','');
        $this->data['model'] = $model;

        return $this->view('index');
    }

    public function actionChangepassword(){

        $model = new FormUser();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $userId = \Yii::$app->user->id;
                $object = User::findOne($userId);
                $object->password_hash = md5($model->password_hash);
                $object->update(true,$model->password_hash==null?['updatetime']:['password_hash','updatetime']);

                $this->flashSuccess(['密码编辑成功']);
                return $this->redirect('index.php?r=backend/self/index');
            }
        }

        $this->flashError($this->getErrorMessage($model));
        $this->data['model'] = $model;

        return $this->view('index');


    }


}