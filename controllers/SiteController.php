<?php

namespace app\controllers;

use app\controllers\forms\FormAdmin;
use app\starter\controllers\FrontendController;
use Yii;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends FrontendController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionError()
    {
        $this->layout = "//content";
        return $this->render('//site/error');
    }

    public function actionLogin()
    {
        $model = new FormAdmin();
        $model->rememberme = isset($_POST['rememberme']) ? true : false;
        if ($model->load(Yii::$app->request->post(), '')) {
            if ($model->validate()) {
                $result = $model->login();
                if ($result) {
                    return $this->redirect("index.php?r=backend/default/index");
                } else {
                    $this->flashError(['用户名或者密码错误']);
                }

            } else {
                $this->flashError(['用户名或者密码不能为空']);
            }
        }

        $this->data['model'] = $model;
        $this->layout = "//backend-login";
        return $this->render('login', $this->data);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('index.php?r=site/login');
    }
}
