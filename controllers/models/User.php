<?php

namespace app\controllers\models;

use Yii;
use yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $username;
    public $userpassword;
    public $rememberme = false;
    public $_user = false;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
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
            'role' => '角色',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    public static function findIdentity($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        return isset($user) ? new static(array(
            'id' => $user['id'],
            'username' => $user->getOldAttributes()['username'],
            'password_hash' => $user->getOldAttributes()['password_hash']
        )) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function login()
    {
        if ($this->validatePassword()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberme ? 3600 * 24 * 30 : 3600);
        }
        return false;

    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::find()->where(['username' => $this->username])->one();;
        }

        return $this->_user;
    }

    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user && $user->getAttribute('password_hash') == md5($this->userpassword)) {
                return true;
            }
        }
        return false;
    }

}
