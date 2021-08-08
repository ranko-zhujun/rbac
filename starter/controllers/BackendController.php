<?php
namespace app\starter\controllers;
use app\modules\backend\controllers\models\Theme;
use Yii;

class BackendController extends AppbaseController
{

    public $cache = null;
    public $userId = null;

    public function behaviors()
    {
        return [
            [
                'class' => 'app\starter\filter\BackendSessionFilter'
            ]
        ];
    }


    public function init()
    {
        parent::init();
        $this->startUp();
    }

    public function startUp()
    {
        session_start();

        $this->layout = '//backend-panel';

        $user = Yii::$app->user;
        $this->userId = $user->id;
        $this->cache = Yii::$app->cache;

    }

    public function getErrorMessage(\yii\base\Model $record){

        $message = [];

        if(sizeof($record->getErrors())>0){
            foreach ($record->getErrors() as $key=>$val){
                $label = $record->attributeLabels()[$key];
                foreach ($val as $v){
                    $message[] = $label.$v;
                }
            }
        }

        return $message;

    }

}
