<?php

namespace app\modules\backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;
use yii\db\Expression;
use yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'email','id'], 'required','message'=>'必填项'],
            [['email'], 'email','message'=>'必须是邮箱'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'username' => '用户名',
            'auth_key' => '校验的KEY',
            'password_hash' => '校验密码',
            'password_reset_token' => '密码重置TOKEN',
            'email' => '邮箱',
            'status' => '状态',
            'createtime' => '创建时间',
            'updatetime' => '修改时间',
        ];
    }

    public static function queryList($pagesize)
    {
        $result = array();
        $condition = [];
        $query = self::find()->where($condition);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->pageSize = $pagesize;
        $list = $query ->orderBy('id desc')->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $result['pagination'] = $pagination;
        $result['list'] = $list;
        return $result;
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createtime',
                'updatedAtAttribute' => 'updatetime',
                'value' => new Expression('NOW()'),
            ],
        ];
    }


}
