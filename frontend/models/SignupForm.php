<?php
namespace frontend\models;

use backend\models\Userdata;
use common\models\User;
use yii\base\Model;
use Yii;
use common\utils\Uuid;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repassword;
    public $verifyCode;
    public $phone;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 0;
    const ROLE_USER = 10;
    const Phone_user = null;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '此用户名已被占用'],
            ['username', 'string', 'min' => 5, 'max' => 255, 'message' => '用户名长度不能小于5'],
            ['username', 'match','pattern'=>'/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})a-zA-Z_\d]*$/u','message'=>'用户名由字母，汉字，数字，下划线组成，且不能以数字和下划线开头。'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '此电子邮件地址已被注册过.'],

            [['password','repassword'],'required'],
            [['password','repassword'], 'string', 'min' => 6],
            ['repassword', 'compare', 'compareAttribute' => 'password','message'=>'两次输入的密码不一致！'],

            ['verifyCode', 'captcha','captchaAction'=>'login/captcha'],

            ['phone', 'required'],

            ['phone','match','pattern'=>'/^[1][34578][0-9]{9}$/','message'=>'请输入正确的手机号码'],
            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => '手机号已被使用'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->id = Uuid::uuid();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->phone = $this->phone;
            $user->status = self::STATUS_ACTIVE;
            $user->role = self::ROLE_USER;
            $user->created_at = date('Y-m-d H:i:s');
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            if($user->save()){
                $userdata = new Userdata();
                $userdata->id = Uuid::uuid();
                $userdata->create_at = $user->created_at;
                $userdata->user_id = $user->id;
                $userdata->save();
            }
            return $user;
        }
        return null;
    }

}
