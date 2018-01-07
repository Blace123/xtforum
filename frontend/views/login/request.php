<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = '修改密码';
?>
<div class="site-contact">
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请填写您的新密码，不要忘记了哦</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'newpassword')->passwordInput(['maxlength' => true,'placeholder'=>'请输入您的新密码'])->label('新密码') ?>
            <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => true,'placeholder'=>'请再次输入您的新密码'])->label('确认新密码') ?>

            <div class="form-group">
                    <?= Html::submitButton('确定', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>