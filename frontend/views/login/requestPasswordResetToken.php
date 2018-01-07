<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = '重置密码';
?>
<div class="site-contact">
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请填写您的电子邮件。我们将在给您发一个重置密码链接。</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'email') ?>
                <div class="form-group">
                    <?= Html::submitButton('确定', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>