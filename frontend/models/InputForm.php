<?php
namespace frontend\models;

use backend\models\Info;
use common\models\User;
use common\models\Plate;
use yii\base\Model;
use Yii;
use common\utils\Uuid;

/**
 * Signup form
 */
class InputForm extends Model
{
    public $title;
    public $content;
    public $class;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title','required','message' => '标题不能为空'],
            ['class','required','message' => '请选择一个版块'],
            ['content','required','message' => '您发布内容不能为空'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save()
    {
        if ($this->validate()) {
            $info   = new Info();
            $info->id = Uuid::uuid();
            $info->title = $this->title;
            $info->content = $this->content;
            $info->create_at =  date('Y-m-d H:i:s');
            $info->user_id = Yii::$app->user->identity->id;
            $info->class =$this->class;
            $info->brief =mb_substr( $this->content, 0, 150,"utf-8");
            $info->save();
            return $info;
        }
        return null;
    }

    public function plate(){
        $plate = Plate::find()->asArray()->all();
        return $plate;

    }

}
