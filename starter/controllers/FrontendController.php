<?php


namespace app\starter\controllers;

use app\controllers\models\Theme;
use app\helpers\ToolsHelper;
use app\models\ThemeDao;
use app\models\FrontendPage;
use app\models\FrontendTheme;
use app\starter\constants\Application;
use Yii;

class FrontendController extends AppbaseController
{

    public $theme = null;
    public $cache = null;

    public function init()
    {
        parent::init();
        $this->startUp();
    }

    public function startUp()
    {

        $this->cache = Yii::$app->cache;

        if (!file_exists(Yii::$app->basePath . '/config/install.lock')) {
            header('Location: index.php?r=install');
            exit();
        } else {
            //判断是否是登录、登出以及错误显示的接口
            $r = $_REQUEST['r'];
            if (!($r == 'site/login' || $r == 'site/logout' || $r == 'site/error')) {
                $this->theme = Yii::$app->params['theme'];
                $this->module->setViewPath($this->module->getBasePath() . DIRECTORY_SEPARATOR . 'themes' .
                    DIRECTORY_SEPARATOR . $this->theme.DIRECTORY_SEPARATOR.'views' );
                $this->visitor();
            }
        }

    }

    private function visitor(){

        $ip = ToolsHelper::getIp();
        $dayEndLimit = ToolsHelper::getDayEndLimit();
        if($this->cache->exists(Application::TODAY_IP)){
            $todayIp = $this->cache->get(Application::TODAY_IP);
        }else{
            $todayIp = array();
        }

        if(!array_key_exists($ip,$todayIp)){
            $todayIp[$ip] = $ip;
            $this->cache->set(Application::TODAY_IP,$todayIp,$dayEndLimit);
        }

        $todayPV = 0;
        if($this->cache->exists(Application::TODAY_PV)){
            $todayPV = $this->cache->get(Application::TODAY_PV);
        }
        $todayPV ++ ;
        $this->cache->set(Application::TODAY_PV,$todayPV,$dayEndLimit);

    }



}
