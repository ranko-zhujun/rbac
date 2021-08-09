<?php

namespace app\controllers\forms;

use app\controllers\models\User;
use Yii;

class FormAdmin extends User
{

    public function rules()
    {
        return [
            [['username', 'userpassword'], 'required', 'message' => '必填项']
        ];
    }

    public function attributeLabels()
    {
        return [
            'loginname' => '登入名称',
            'loginpassword' => '登入密码'
        ];
    }


}