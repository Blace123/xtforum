<?php

namespace backend\models;

use Yii;
use backend\models\Info;
/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property string $content
 * @property string $image
 * @property string $create_at
 * @property string $user_id
 * @property string $info_id
 * @property string $pid
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'content'], 'required'],
            [['content'], 'string'],
            [['id', 'create_at', 'user_id', 'info_id', 'pid'], 'string', 'max' => 32],
            [['image'], 'string', 'max' => 255],
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
            'content' => 'Content',
            'image' => 'Image',
            'create_at' => 'Create At',
            'user_id' => 'User ID',
            'info_id' => 'Info ID',
            'pid' => 'Pid',
        ];
    }

    public function getUser(){
        //根据文章查用户；一对一
        $user = $this->hasOne(Userdata::className(),['user_id'=>'user_id'])->one();
        return $user;
    }
}
