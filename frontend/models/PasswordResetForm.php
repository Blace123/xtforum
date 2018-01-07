<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Password reset request form
 */
class PasswordResetForm extends Model
{
    public $newpassword;
    public $repassword;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newpassword','repassword'],'required','message'=>'新的密码不能为空'],
            [['newpassword','repassword'], 'string', 'min' => 6],
            ['repassword', 'compare', 'compareAttribute' => 'newpassword','message'=>'两次输入的密码不一致！'],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendPassword()
    {
        if ($this->validate()) {
            $user = User::find()->where(['id'=>Yii::$app->user->identity->id])->one();
            $user->setPassword($this->newpassword);
            $user->save();
            return $user;
        }
            return false;
    }
}
