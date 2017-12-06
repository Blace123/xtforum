<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */


$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'phone')?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'repassword')->passwordInput()?>
                <?= $form->field($model,'verifyCode')->widget(yii\captcha\Captcha::className()
                    ,['template' => '<div class="row"><div class="col-lg-3"> {image}</div><div class="col-lg-6">{input}</div></div>',
                           'captchaAction'=>'login/captcha',
                        'imageOptions'=>['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer'] ]);?>
    `
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php if( Yii::$app->getSession()->hasFlash('success') ) {
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-success', //这里是提示框的class
                    ],
                    'body' => Yii::$app->getSession()->getFlash('success'), //消息体
                ]);
            }
            if( Yii::$app->getSession()->hasFlash('error') ) {
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-error',
                    ],
                    'body' => Yii::$app->getSession()->getFlash('error'),
                ]);
            }?>
            <?php ActiveForm::end(); ?>



            <?=Html::a('修改密码', '#', [
                'id' => 'account-changepwd',
                'class' => 'btn btn-success',
                'data-toggle' => 'modal',
                'data-url' => Url::toRoute(['/login/signup']),
                'data-title' => '修改密码',
                'data-target' => '#common-modal',
            ])?>
            <!--失效原因，上面已经有modal应用-->
        </div>
    </div>
</div>
