<?php

namespace app\modules\install\controllers;

use app\helpers\SqlHelper;
use app\starter\controllers\InstallController;
use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;

class DefaultController extends InstallController
{
    public function actionIndex()
    {
        $installRequire = require FileHelper::normalizePath(\Yii::$app->basePath.'/web/setup/requirements.php') ;
        $license = $this->renderFile(FileHelper::normalizePath(\Yii::$app->basePath.'/web/setup/license.php'));
        return $this->render('index',array('installRequire'=>$installRequire,'license'=>$license));
    }

    public function actionInstall(){
        $host = $_REQUEST['host'];
        $port = $_REQUEST['port'];
        $installdb = $_REQUEST['db'];
        $user = $_REQUEST['user'];
        $pwd = $_REQUEST['pwd'];

        $config = [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.$host.':'.$port.';dbname='.$installdb,
            'username' => $user,
            'password' => $pwd,
            'charset' => 'utf8',
        ];

        $db = Yii::createObject($config);

        $db->open();
        //导入SQL脚本，进行安装
        $sqlPath = FileHelper::normalizePath(Yii::$app->getBasePath().'/web/setup/resources/install.sql');
        $sqlList = SqlHelper::getSqlFromFile($sqlPath);
        foreach ($sqlList as $sql) {
            $db->createCommand($sql)->execute();
        }
        $db->close();


        $installLock = FileHelper::normalizePath(Yii::$app->getBasePath().'/config/install.lock');
        $lockFile = fopen($installLock, "w") or die("无法打开文件");
        $txt = date('Y-m-d H:i:s');
        fwrite($lockFile, $txt);
        fclose($lockFile);

        $dbConfig = FileHelper::normalizePath(Yii::$app->getBasePath().'/config/db.php');
        $configFile = fopen($dbConfig, "w") or die("无法打开文件");
        $dbConfigStrings = '<?php
            return [
                \'class\' => \'yii\db\Connection\',
                \'dsn\' => \'mysql:host='.$host.':'.$port.';dbname='.$installdb.'\',
                \'username\' => \''.$user.'\',
                \'password\' => \''.$pwd.'\',
                \'charset\' => \'utf8\'
            ];
            ';
        fwrite($configFile, $dbConfigStrings);
        fclose($configFile);

        return $this->redirect("index.html");

    }

    public function actionDbtest(){

        $host = $_REQUEST['host'];
        $port = $_REQUEST['port'];
        $db = $_REQUEST['db'];
        $user = $_REQUEST['user'];
        $pwd = $_REQUEST['pwd'];

        $config = [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.$host.':'.$port.';dbname='.$db,
            'username' => $user,
            'password' => $pwd,
            'charset' => 'utf8',
        ];

        $db = Yii::createObject($config);
        try{
            $db->open();
            echo 'ok';
        }catch (yii\db\Exception $exception){
            echo 'error';
        }
        exit();
    }


}
