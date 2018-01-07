<?php

namespace backend\models;

use Yii;
use backend\models\Userdata;
use backend\models\Comment;
/**
 * This is the model class for table "info".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $create_at
 * @property string $user_id
 * @property string $class_id
 */
class Info extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info';
    }

//    public function relations()
//    {
//        return array(self::BELONGS_TO,'user',array('user_id'=>'id'));
//    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'image' => 'Image',
            'create_at' => 'Create At',
            'user_id' => 'User_id',
            'class_id' => 'Class ID',
        ];
    }
    public function getUser(){
        //根据文章查用户；一对一
        $user = $this->hasOne(Userdata::className(),['user_id'=>'user_id'])->one();
        return $user;
    }

    public function getComment(){
        $comment = $this->hasMany(Comment::className(),['info_id'=>'id'])->orderBy('create_at');
        return $comment;
    }
}
