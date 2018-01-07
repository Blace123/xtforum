<?php

namespace backend\models;

use Yii;
use backend\models\Userdata;
/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $phone
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at','phone'], 'required'],
            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['id', 'auth_key'], 'string', 'max' => 32],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'role' => 'Role',
            'status' => 'Status',
            'phone' => 'Phone',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public  function getuserdata(){
        $userdata = $this->hasOne(Userdata::className(),['user_id'=>'id'])->asArray()->all();
        return $userdata;
    }

}
