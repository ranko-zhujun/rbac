<?php

namespace app\modules\backend\controllers;

use app\modules\backend\forms\FormUser;
use app\modules\backend\models\User;
use app\starter\controllers\BackendController;
use Yii;
use yii\base\BaseObject;
use yii\web\Controller;

class UserController extends BackendController
{
    public function actionIndex()
    {
        $this->data['userlist'] = User::queryList(10);

        return $this->view('index');
    }

    public function actionEdit($id=0)
    {
        $authManager = Yii::$app->authManager;
        $model = new FormUser();
        if($id!=0){
            $user = User::findOne($id);
            $model->setAttributes($user->getAttributes(),false);
            $model->setAttribute('password_hash','');
        }else{
            $model->id = 0;
        }
        $this->data['model'] = $model;

        $roles = $authManager->getRoles();
        $this->data['roles'] = $roles;

        return $this->view('edit');
    }

    public function actionSave(){
        $model = new FormUser();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                $authManager = Yii::$app->authManager;

                if ($model->id == 0) {
                    $object = new User();
                    $object->setAttributes($model->getAttributes(),false);
                    $object->status = 'active';
                    $object->password_hash = md5($model->password_hash);
                    $object->super = 0;
                    $object->save();
                } else {
                    $object = User::findOne($model->id);
                    $object->setAttributes($model->getAttributes(null,['username','email','status']),false);
                    $object->password_hash = md5($model->password_hash);
                    $object->update(true,$model->password_hash==null?['updatetime']:['password_hash','updatetime']);
                    $authManager ->revokeAll($model->id);
                }

                //权限赋予
                if($_REQUEST['roles']!=null&&sizeof($_REQUEST['roles'])>0){
                    $roles = $_REQUEST['roles'];
                    foreach ($roles as $role){
                        $authManager->assign($authManager->getRole($role),$object->id);
                    }
                }

                $this->flashSuccess(['用户编辑成功']);

                return $this->redirect('index.php?r=backend/user/index');
            }
        }

        $this->flashError($this->getErrorMessage($model));

        $this->data['model'] = $model;

        $authManager = Yii::$app->authManager;
        $roles = $authManager->getRoles();
        $this->data['roles'] = $roles;

        return $this->view('edit');

    }

}
