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
        }
    }



}
