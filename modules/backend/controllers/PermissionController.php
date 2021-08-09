<?php

namespace app\modules\backend\controllers;

use app\modules\backend\forms\FormPermission;
use app\starter\controllers\BackendController;
use app\starter\rbac\rule\AuthorRule;
use Yii;
use yii\base\BaseObject;
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

        $model = new FormPermission();
        $this->data['model'] = $model;

        return $this->view('edit');
    }

    public function actionSave(){
        $model = new FormPermission();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $authManager = Yii::$app->authManager;
                $permission = $authManager->getPermission($model->name);
                if($permission){
                    $this->flashError(['权限已经存在，添加失败']);
                    return $this->view('edit');
                }else{
                    $permission = $authManager->createPermission($model->name);
                    $permission->description = $model->description;
                    $authManager->add($permission);
                    $this->flashSuccess(['权限删除成功']);
                    return $this->redirect('index.php?r=backend/permission/index');
                }
            }
        }

        $this->flashError($this->getErrorMessage($model));

        $this->data['model'] = $model;
        return $this->view('edit');

    }

    public function actionDelete($name)
    {
        $authManager = Yii::$app->authManager;
        $permission = $authManager->getPermission($name);
        if($permission){
            if($authManager->remove($permission)){
                $this->flashSuccess(['权限删除成功']);
            }else{
                $this->flashError(['权限删除失败']);
            }
        }else{
            $this->flashError(['权限删除失败']);
        }

        return $this->redirect('index.php?r=backend/permission/index');
    }

}
