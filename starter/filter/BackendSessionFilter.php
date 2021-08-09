<?php

namespace app\starter\filter;

use Yii;
use yii\base\ActionFilter;
use yii\base\UserException;
use yii\web\HttpException;
use yii\web\UnauthorizedHttpException;

class BackendSessionFilter extends ActionFilter
{

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            header("location:index.php?r=site/login");
            exit();
        } else {

            return parent::beforeAction($action);

/*            $permission = $action->controller->module->id.'/'.$action->controller->id.'/'.$action->id;
            if(\Yii::$app->user->can($permission)){
                return parent::beforeAction($action);
            }else{
                throw new UnauthorizedHttpException($permission);
            }*/
        }

    }

}