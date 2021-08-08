<?php

namespace app\starter\filter;

use Yii;
use yii\base\ActionFilter;

class BackendSessionFilter extends ActionFilter
{

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            header("location:index.php?r=site/login");
            exit();
        } else {
            return parent::beforeAction($action);
        }

    }

}