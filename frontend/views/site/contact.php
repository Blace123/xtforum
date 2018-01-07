<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use light\widgets\SweetSubmitAsset;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = '联系我们';
$this->params['breadcrumbs'][] = $this->title;
SweetSubmitAsset::register($this);


?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        如果您有业务问题或其他问题，请填写以下表格与我们联系。谢谢您的反馈.
    </p>


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form',
                'enableClientScript' => false,
                'enableClientValidation' => false]); ?>
                <?= $form->field($model, 'name')->label('您的姓名:') ?>
                <?= $form->field($model, 'email')->label('您的邮箱:') ?>
                <?= $form->field($model, 'subject')->label('标题:') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6])->label('反馈内容:') ?>
            <?= $form->field($model,'verifyCode')->widget(yii\captcha\Captcha::className()
                ,['template' => '<div class="row"><div class="col-lg-3"> {image}</div><div class="col-lg-6">{input}</div></div>',
                    'captchaAction'=>'/site/captcha',
                    'imageOptions'=>['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer'] ])->label('请输入验证码:');?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

