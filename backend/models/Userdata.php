<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "userdata".
 *
 * @property string $id
 * @property string $qq
 * @property string $phone
 * @property string $email
 * @property string $name
 * @property string $sex
 * @property string $birthday
 * @property string $address
 * @property string $hobby
 * @property string $image
 * @property string $motto
 * @property string $update_at
 * @property string $user_id
 */
class Userdata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userdata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'update_at', 'user_id'], 'string', 'max' => 32],
            [['qq', 'phone', 'email', 'name', 'sex', 'birthday', 'address', 'hobby', 'image', 'motto'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qq' => 'Qq',
            'phone' => 'Phone',
            'email' => 'Email',
            'name' => 'Name',
            'sex' => 'Sex',
            'birthday' => 'Birthday',
            'address' => 'Address',
            'hobby' => 'Hobby',
            'image' => 'Image',
            'motto' => 'Motto',
            'update_at' => 'Update At',
            'user_id' => 'User ID',
            'create_at' => 'Create At',
        ];
    }


}
