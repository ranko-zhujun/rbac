<?php


namespace app\widgets;

use app\starter\constants\MessageType;
use app\starter\constants\Msgtype;
use Yii;

class Message extends \yii\bootstrap\Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $alerthtml = '';

        foreach ($flashes as $type => $flash) {

            if ($type == MessageType::SUCCESS) {
                $alerthtml .= '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    ' . $this->getFlashStrings($flash) . '
                </div>';
            } else if ($type == MessageType::ERROR) {
                $alerthtml .= '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    ' . $this->getFlashStrings($flash) . '
                </div>';
            }

            $session->removeFlash($type);
            return $alerthtml;
        }
    }

    private function getFlashStrings($flash)
    {
        $flashStrings = '';
        foreach ($flash as $key => $val) {
            if ($key != 0) {
                $flashStrings .= '<br>';
            }
            $flashStrings .= $val . ' .';

        }
        return $flashStrings;
    }
}
