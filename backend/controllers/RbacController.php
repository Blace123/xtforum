<?php
namespace backend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use backend\models\Rbac;
use backend\models\AuthItem;


class RbacController extends Controller{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionIndex(){
        $model = new Rbac();
        return $this->render('rw',['model'=>$model]);

        //return $this->render('index',['model'=>$model]);
    }
    public function actionPw(){
        $model = new Rbac();
        return $this->render('rw',['model'=>$model]);
    }
    public function actionPower()
    {
        $item = \Yii::$app->request->post('Rbac')['power'];
        $auth = Yii::$app->authManager;
        $createPost = $auth->createPermission($item);
        $createPost->description = '创建了 ' . $item . ' 权限';
        $auth->add($createPost);
        return $this->redirect('index');
    }
//第一步 添加权限
    public function actionRole(){
        $model = new Rbac();
            return $this->render('role',['model'=>$model]);
    }

    public function actionAddrole(){
        $item = \Yii::$app->request->post('Rbac')['role'];
        $auth = Yii::$app->authManager;
        $role = $auth->createRole($item);
        $role->description = '创建了 ' . $item . ' 角色';
        $auth->add($role);

        return $this->redirect('rp');
    }
    //然后将角色入库

    public function actionRp(){
        $model = new Rbac();
        $role =  AuthItem::find()->where('type=1')->asArray()->all();
        foreach($role as $value){
            $roles[$value['name']] = $value['name'];
        }
        $power=  AuthItem::find()->where('type=2')->asArray()->all();
        foreach($power as $value){
            $powers[$value['name']] = $value['name'];
        }

        return $this->render('rp',['model'=>$model,'role'=>$roles,'power'=>$powers]);
    }
    //然后给角色分配权限

    public function actionEmpowerment(){
        $auth = Yii::$app->authManager;
        $data = \Yii::$app->request->post('Rbac');
        $role = $data['role'];
        $power = $data['power'];

        foreach($role as $value){
            foreach($power as $v){
                $parent = $auth->createRole($value);

                $child = $auth->createPermission($v);
                //var_dump($child);
                $auth->addChild($parent, $child);
            }
        }
        return $this->redirect('fenpei');
    }
    //然后入库


    public function actionFenpei(){
        $model = new Rbac();
        $role =  AuthItem::find()->where('type=1')->asArray()->all();
        foreach($role as $value){
            $roles[$value['name']] = $value['name'];
        }
        $user=  User::find()->asArray()->all();
        foreach($user as $value){
            $users[$value['id']] = $value['username'];
        }
        return $this->render('fenpei',['model'=>$model,'role'=>$roles,'user'=>$users]);
    }
    //然后给用户分配角色

    public function actionUr(){
        $auth = Yii::$app->authManager;
        $data = \Yii::$app->request->post('Rbac');
        $role = $data['role'];
        $power = $data['user'];

        foreach($role as $value) {
            foreach ($power as $v) {
                $reader = $auth->createRole($value);
                $auth->assign($reader, $v);
            }
        }
        return $this->redirect('index');

        //将给用户分配的角色入库
    }

}