<?php
namespace frontend\models;

use backend\models\Comment;
use common\models\User;
use common\models\Plate;
use yii\base\Model;
use Yii;
use common\utils\Uuid;

/**
 * Signup form
 */
class CommentForm extends Model
{
    public $content;
    public $image;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['content','required','message' => '您发布内容不能为空'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save($info_id)
    {
        if ($this->validate()) {
            $common   = new Comment();
            $common->id = Uuid::uuid();
            $common->content = $this->content;
            $common->create_at =  date('Y-m-d H:i:s');
            $common->user_id = Yii::$app->user->identity->id;
            $common->info_id =$info_id;
            $common->image = $this->image;
            $common->save();
            return $common;
        }
        return null;
    }

    public function plate(){
        $plate = Plate::find()->asArray()->all();
        return $plate;

    }

}
