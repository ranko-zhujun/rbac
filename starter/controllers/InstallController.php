<?php


namespace app\starter\controllers;


use Yii;
use yii\web\Controller;

class InstallController extends Controller
{

    public $layout = "install";


    function init()
    {
        parent::init();
        if (file_exists(Yii::$app->basePath . '/config/install.lock')) {
            header('Location: index.php');
        }
    }

}