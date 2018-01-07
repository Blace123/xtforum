<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */


$this->title = '用户注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$js =<<<JS
    $("#info-btn").on("click", function(e){
    e = e||event;
    $("#info").toggleClass("show-info");
    $("#info").on("click", function(e){e.stopPropagation();})
    e.stopPropagation();
    $(document).one("click", function(e){
      $("#info").removeClass("show-info");
      e.stopPropagation();
    })
  })
        $("#top-user-btn").on("click", function(e){
            e = e||event;
            $("#top-user").toggleClass("show-info");
            $("#top-user").on("click", function(e){
                e.stopPropagation();
         
            })
            e.stopPropagation();

            $(document).one("click", function(e){
              $("#top-user").removeClass("show-info");
        
              e.stopPropagation();
            })
          })
JS;
$this->registerJs($js);
?>
<div class="container">
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请注册您的账户:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->label('用户名:') ?>
                <?= $form->field($model, 'email')->label('邮箱:') ?>
                <?= $form->field($model, 'phone')->label('手机号码:')?>
                <?= $form->field($model, 'password')->passwordInput()->label('密码:') ?>
                <?= $form->field($model, 'repassword')->passwordInput()->label('确认密码:')?>
                <?= $form->field($model,'verifyCode')->widget(yii\captcha\Captcha::className()
                    ,['template' => '<div class="row"><div class="col-lg-3"> {image}</div><div class="col-lg-6">{input}</div></div>',
                           'captchaAction'=>'login/captcha',
                        'imageOptions'=>['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer'] ])->label('请输入验证码:');?>
    `
                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    <?=Html::resetButton( '重置',['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
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



<!--            <?=Html::a('修改密码', '#', [
                'id' => 'account-changepwd',
                'class' => 'btn btn-success',
                'data-toggle' => 'modal',
                'data-url' => Url::toRoute(['/login/signup']),
                'data-title' => '修改密码',
                'data-target' => '#common-modal',
            ])?>!>
            <!--失效原因，上面已经有modal应用-->
        </div>
    </div>
</div>
</div>
