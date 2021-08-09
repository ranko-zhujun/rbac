<?php

namespace app\controllers\forms;

use app\controllers\models\User;
use Yii;

class FormAdmin extends User
{

    public function rules()
    {
        return [
            [['username', 'userpassword'], 'required']
        ];
    }




}