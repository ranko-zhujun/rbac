<?php

namespace app\modules\backend\controllers;

use app\modules\backend\forms\FormRole;
use app\starter\controllers\BackendController;
use Symfony\Component\DomCrawler\Form;
use Yii;
use yii\base\BaseObject;
use yii\web\Controller;

class RoleController extends BackendController
{
    public function actionIndex()
    {
        $authManager = Yii::$app->authManager;

        $roles = $authManager->getRoles();
        $this->data['roles'] = $roles;

        return $this->view('index');
    }

    public function actionDelete($name)
    {
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($name);
        if($role){
            if($authManager->remove($role)){
                $this->flashSuccess(['角色删除成功']);
            }else{
                $this->flashError(['角色删除失败']);
            }
        }else{
            $this->flashError(['角色删除失败']);
        }

        return $this->redirect('index.php?r=backend/role/index');
    }

    public function actionEdit(){

        $model = new FormRole();
        $this->data['model'] = $model;

        $authManager = Yii::$app->authManager;
        $permissions = $authManager->getPermissions();
        $this->data['permissions'] = $permissions;

        return $this->view('edit');
    }

    public function actionSave(){
        $model = new FormRole();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $authManager = Yii::$app->authManager;
                $role = $authManager->getRole($model->name);
                if($role){
                    $this->flashError(['角色已经存在，添加失败']);
                    return $this->view('edit');
                }else{
                    $role = $authManager->createRole($model->name);
                    $role->description = $model->description;
                    $authManager->add($role);
                    if($_REQUEST["permissions"]!=null && sizeof($_REQUEST["permissions"])>0){
                        foreach ($_REQUEST["permissions"] as $permission){
                            $authManager->addChild($role, $authManager->getPermission($permission));
                        }
                    }
                    $this->flashSuccess(['角色添加成功']);
                    return $this->redirect('index.php?r=backend/role/index');
                }
            }
        }

        $this->flashError($this->getErrorMessage($model));

        $this->data['model'] = $model;
        return $this->view('edit');

    }

}
