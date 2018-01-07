<?php

namespace common\models;

use Yii;
use backend\models\Info;
use common\models\User;
/**
 * This is the model class for table "plate".
 *
 * @property string $id
 * @property string $name
 * @property string $owner
 * @property string $create_at
 */
class Plate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%plate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'owner'], 'required'],
            [['id', 'owner'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 255],
            [['create_at'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'owner' => 'Owner',
            'create_at' => 'Create At',
        ];
    }

    public function getInfo(){
        //根据类别查文章；一对多
        $info = $this->hasMany(Info::className(),['class'=>'id'])->orderBy('create_at DESC')->asArray()->all();
        return $info;
    }

}
