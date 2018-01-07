<?php
namespace frontend\models;

use backend\models\Userdata;
use common\models\User;
use common\models\Plate;
use yii\base\Model;
use Yii;
use common\utils\Uuid;

/**
 * Signup form
 */
class UserdataForm extends Model
{
    public $qq;
    public $phone;
    public $email;
    public $name;
    public $sex;
    public $birthday;
    public $address;
    public $hobby;
    public $motto;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['qq','required','message' => 'qq不能为空'],
            ['phone','required','message' => '电话不能为空'],
            ['phone','match','pattern'=>'/^[1][34578][0-9]{9}$/','message'=>'请输入正确的手机号码'],
            ['email','required','message' => '邮箱不能为空'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email','message'=> '请输入正确的邮箱地址'],
            ['address','required','message' => '地址不能为空'],
            ['birthday','required','message' => '生日不能为空'],
            ['name','required','message' => '昵称不能为空'],
            ['hobby','required','message' => '爱好不能为空'],
            ['motto','required','message' => '个性签名不能为空'],
            ['sex','required','message' => '请选择您的性别'],
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

            $data= new Userdata();
            $data->id = Uuid::uuid();
            $data->qq = $this->qq;
            $data->phone = $this->phone;
            $data->email = $this->email;
            $data->update_at =  date('Y-m-d H:i:s');
            $data->user_id = Yii::$app->user->identity->id;
            $data->name = $this->name;
            $data->sex = $this->sex;
            $data->address = $this->address;
            $data->birthday = $this->birthday;
            $data->hobby = $this->hobby;
            $data->motto = $this->motto;
            $data->save();
            return $data;
        }

    }

    public function data($id){
        $data =Userdata::find()->where(['user_id'=>$id])->asArray()->one();
        return $data;

    }

    //查询用户信息是否存在

}
