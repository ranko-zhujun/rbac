<?php


namespace app\starter\controllers;


use app\starter\constants\MessageType;
use Yii;
use yii\web\Controller;

class AppbaseController extends Controller
{
    public $layout = "main";
    public $data = array();

    public function view($view){
        return $this->render($view,$this->data);
    }

    public function message($code, $message)
    {
        return ['code' => $code, 'message' => $message];
    }

    public function flashError($message){
        Yii::$app->session->setFlash(MessageType::ERROR, $message);
    }

    public function flashSuccess($message){
        Yii::$app->session->setFlash(MessageType::SUCCESS, $message);
    }


}