<?php
namespace frontend\controllers;

use backend\models\Info;
use backend\models\Comment;
use backend\models\Userdata;
use common\models\Plate;
use Yii;
use common\models\LoginForm;
use frontend\models\InputForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\UploadForm;
use frontend\models\UserdataForm;
use frontend\models\CommentForm;
use yii\web\UploadedFile;
use yii\data\Pagination;
use frontend\models\SiteSearch;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 4169E1,//背景颜色
                'maxLength' => 4, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 5,//间距
                'height' => 35,//高度
                'width' => 100,  //宽度
                'foreColor' => 0xfffff2,     //字体颜色
                'offset' => 10,
            ],
            'crop'=>[
                'class' => 'hyii2\avatar\CropAction',
                'config'=>[
                    'bigImageWidth' => '200',     //大图默认宽度
                    'bigImageHeight' => '200',    //大图默认高度
                    'middleImageWidth'=> '100',   //中图默认宽度
                    'middleImageHeight'=> '100',  //中图图默认高度
                    'smallImageWidth' => '50',    //小图默认宽度
                    'smallImageHeight' => '50',   //小图默认高度
                    //头像上传目录（注：目录前不能加"/"）
                    'uploadPath' => '../web/statics/uploads',
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $model = new InputForm;
        $plate = $model->plate();
        if(Yii::$app->request->get('class_id')){
            $class_id = Yii::$app->request->get('class_id');
            $class = Plate::find()->where(['id' => $class_id])->one();
            $class_name =  $class->name;
            $owner = $class->owner;
            $info = Info::find()->where(['class'=>$class_id])->orderBy('create_at DESC')->asArray();
            $platename = "<div class=in_banzhu>版主</div>";
            //$info = Info::find()->where();
        }
        else{
            $class_name ="分类";
            $info = Info::find()->orderBy('create_at DESC')->asArray();
            $platename = null;
            $owner = null;
        }
        $models =new SiteSearch();
        if($models->load(Yii::$app->request->post())){
            if(!Yii::$app->user->isGuest){
             $content=$models->content;
            $this->actionSearch($content);
            $info = $this->actionSearch($content);
            }
            else{
                Yii::$app->session->setFlash('error', '请先登陆才能使用搜索功能');
                return $this->redirect('/login/login');

            }
        }
        $pages = new Pagination(['totalCount' =>$info->count(), 'pageSize' => '6']);
        $info = $info->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',[
            'plate' => $plate,
            'class_name' => $class_name,
            'info' => $info,
            'pages' => $pages,
            'platename' =>$platename,
            'owner' =>$owner
            ]);
    }

    public function actionSearch($content){
        $info=Info::find()->andFilterWhere(['like', 'title', $content])->orFilterWhere(['like','content',$content])->orderBy('create_at DESC')->asArray();
        //$model = Info::find()->joinWith('comment')->andFilterWhere(['like','info.title',$content])->asArray()->all();

        //$info=Info::find()->andFilterWhere(['like', 'title', $content])->andFilterWhere(['like', 'content', $content])->asArray()->all(); //此方法是用 like 查询 name 等于 小伙儿的 数据
//        $comment =Comment::find()->andFilterWhere(['like', 'content', $content])->asArray()->all();
//        //var_dump($comment);
//        foreach ($comment as $item){
//            $id = $item['info_id'];
//
//            $infos=Info::find()->where(['id'=>$id])->asArray()->all();
//            echo var_dump($infos);
//        }//相关文章评论
        return $info;
    }

    public function actionView(){
		$model = new InputForm;
        $plate = $model->plate();
        if(Yii::$app->request->get('info_id')) {
            $info_id = Yii::$app->request->get('info_id');
            $info = Info::find()->where(['id' => $info_id])->one();
            $infouser = $info->user_id;
            $comment = $info->getcomment();

            $pages = new Pagination(['totalCount' =>$comment->count(), 'pageSize' => '10']);
            $comment = $comment->offset($pages->offset)->limit($pages->limit)->all();
            $model = new CommentForm;
            $models = new UserdataForm();
            if (!Yii::$app->user->isGuest) {
                $data = $models->data(Yii::$app->user->identity->id);
                if ($model->load(Yii::$app->request->post())) {
                    if ($model->save($info_id)) {
                        Yii::$app->session->setFlash('success', '评论成功~');
                        return $this->redirect('/site/view?info_id=' . $info_id);
                    }
                }
                $lz ="<div class=ht_louzhu>楼主</div>";
                return $this->render('comment', [
                    'info' => $info,
                    'infouser' =>$infouser,
                    'model' => $model,
                    'comment' => $comment,
                    'models' => $models,
                    'data' => $data,
                    'pages' => $pages,
                    'lz' => $lz,
					'plate' => $plate,
                ]);
            }else{
                if ($model->load(Yii::$app->request->post())) {
                    if(!Yii::$app->user->isGuest){
                        if ($model->save($info_id)) {
                            Yii::$app->session->setFlash('success', '评论成功~');
                            return $this->redirect('/site/view?info_id=' . $info_id);
                        }
                    }
                    else {
                        Yii::$app->session->setFlash('error', '请先登陆才能发表您的评论');
                        return $this->redirect('/login/login');
                    }
                }
				$lz =null;
                return $this->render('comment', [
					'lz' => $lz,	
					'infouser' =>$infouser,
                    'info' => $info,
                    'model' => $model,
                    'comment' => $comment,
                    'models' => $models,
                    'pages' => $pages,
					'plate' => $plate,
                ]);
            }
        }
        else{
            \Yii::$app->getSession()->setFlash('error', '请点击你想要查看的文章');
            return $this->redirect('/site/index');
        }

    }

    public function actionInput()
    {

        if(!Yii::$app->user->isGuest){
        $model = new InputForm;
        $plate = $model->plate();
       //   = new Info();
        for ($a=0;$a<count($plate);$a++){
            $name[] =$plate[$a]['name'];
            $id[] = $plate[$a]['id'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', '话题发布成功');
                return $this->redirect('/site/index');
        }
        else{

        }
        return $this->render('input',[
                'plate' => $plate,
                'model' => $model,
        ]);
         }
         else{
            \Yii::$app->getSession()->setFlash('error', '请先登陆');
            return $this->redirect('/login/login');

    }

    }



    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
/*            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }*/
            Yii::$app->session->setFlash('success', '谢谢您的反馈，我们将在第一时间给予您回复.');

            return $this->refresh();
        } else {


            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    public function actionUserinfo(){
        if(Yii::$app->request->get('userid')) {
            $id = Yii::$app->request->get('userid');
            $data = Userdata::find()->where(['user_id'=>$id])->one();
            $info = Info::find()->where(['user_id' =>$id])->asArray()->all();
            return $this->render('userinfo', [
                'data' => $data,
                'info' =>$info
            ]);
        }else{
            \Yii::$app->getSession()->setFlash('error', '请选择你要查看的用户');
            return $this->redirect('/site/index');
        }

    }
    public function actionAboutuser()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new UserdataForm();
            $data = Userdata::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
            if ($model->load(Yii::$app->request->post())) {
                if($model->validate()){
                $data['qq'] = $model->qq;
                $data['email'] = $model->email;
                $data['phone'] = $model->phone;
                $data['name'] = $model->name;
                $data['address'] = $model->address;
                $data['sex'] = $model->sex;
                $data['hobby'] = $model->hobby;
                $data['motto'] = $model->motto;
                $data['birthday'] = $model->birthday;
                $data->save();
                    \Yii::$app->getSession()->setFlash('success', '保存成功');
                    return $this->redirect('/site/aboutuser');
                }
            }
            else{
            }
            return $this->render('aboutuser', [
                'model' => $model,
                'data' => $data
            ]);


        } else {
            \Yii::$app->getSession()->setFlash('error', '请先登陆');
            return $this->redirect('/login/login');

        }
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                $model->file->saveAs('../web/statics/uploads/' . $model->file->baseName . '.' . $model->file->extension);
                $name = '../statics/uploads/'.$model->file->baseName. '.' . $model->file->extension;
            }

        }
        else {
            $name = "55555555555";
        }
        return $this->render('upload', [
            'model' => $model ,
            'name' => $name

        ]);
    }




}
