<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\bootstrap\Modal;
use common\models\User;
use yii\web\NotFoundHttpException;
use frontend\models\PasswordResetForm;

class LoginController extends Controller
{
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
        ];
    }

    public function actionIndex()
    {
        $model = new SignupForm();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $email = $model->email;
                $name = $model->username;
                $em_1 = md5($email);
                $mail = Yii::$app->mailer->compose();
                $mail->setTo($email);
                $mail->setSubject("恭喜你注册成功！！点击激活加入我们");
                //发布可以带html标签的文本
                $mail->setHtmlBody("亲爱的 .$name.：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<a href='http://www.xtforum.com:84/login/authentication?&em_1=" . $em_1 . "&email=" . $email . "'><h2>点击此链接完成激活</h2></a>
                    <br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- <a href='http://www.xtforum.com:84>晓涛论坛至上</a></p>");
                if ($mail->send()) {
                    \Yii::$app->getSession()->setFlash('success', '注册成功，请登陆您的邮箱激活您的账号');
                    return $this->redirect(['/login/login']);
                } else {
                    \Yii::$app->getSession()->setFlash('error', '注册失败，请重新注册');
                }
            } else {
                echo "false";
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionAuthentication()
    {
        $model = new SignupForm();
        $email = Yii::$app->request->get('email');
        $ems = Yii::$app->request->get('em_1');
        if ($email != null) {
            $em = md5($email);
            if ($em = $ems) {
                $model = User::find()->where(['email' => $email])->one();

                if ($model->status == 1) {
                    \Yii::$app->getSession()->setFlash('error', '该账户激活链接已失效或已完成过激活');
                    return $this->redirect(['/login/login']);
                } else {
                    $model->status = 1;
                    if ($model->save()) {
                        \Yii::$app->getSession()->setFlash('success', '激活成功，请登陆');
                        $this->redirect(['/login/login']);
                    } else {
                        \Yii::$app->getSession()->setFlash('error', '激活失败，请重试');
                    }
                }
            } else {
                \Yii::$app->getSession()->setFlash('error', '激活失败，请重新注册');
            }
        }

    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', '发送成功！请查看您的电子邮箱完成密码重置.');

                return $this->redirect('/login/login');
            } else {
                Yii::$app->getSession()->setFlash('error', '对不起，我们无法为所提供的电子邮件重置密码。

.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', '密码重置完成.');

            return $this->redirect('/login/login');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRequestpassword()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new PasswordResetForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                //$model->sendPassword(Yii::$app->user->identity->password);

                if ($model->sendPassword()) {
                    Yii::$app->user->logout();
                    Yii::$app->getSession()->setFlash('success', '密码重置完成.请重新登陆');
                    return $this->redirect('/login/login');
                }
            }
            return $this->render('request', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', '请先登陆才能修改密码');
            return $this->redirect('/login/login');
        }


    }
}