<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';

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
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请填写您的用户名和密码进行登录：</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->textInput(['placeholder'=>'请输入您的用户名/邮箱/手机号'])->label('账户') ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'请输入您的密码'])->label('密码') ?>
                <?= $form->field($model, 'rememberMe')->checkbox()->label('记住我') ?>
            <?= Html::a("忘记密码",['/login/request-password-reset']) ?>
                <div style="color:#999;margin:1em 0">
                    还没有账号？那您可以点击<?= Html::a('注册', ['/login/signup']) ?>.加入我们
                </div>
                <div class="form-group">
                    <?= Html::submitButton('登陆', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?=Html::resetButton( '重置',['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

    <?php //$requestUrl = Url::toRoute('login/request-password-reset');
    //$js = <<<JS
    //    $(document).on('click', '#reset', function () {
    //        $.get('{$requestUrl}', {},
    //            function (data) {
    //                $('.modal-body').html(data);
    //            }
    //        );
    //    });
    //JS;
    //$this->registerJs($js);
    //?>