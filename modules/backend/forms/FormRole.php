<?php
namespace app\modules\backend\forms;

class FormRole  extends \yii\base\Model
{

    public $description,$name;

    public function rules()
    {
        return [
            [['name', 'description'], 'required', 'message' => '必填项']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'description' => '描述'
        ];
    }


}