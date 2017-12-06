<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    'action'=>'power',
    'method'=>'post',
]) ?>
<?= $form->field($model, 'power') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('添加权限', ['class' => 'btn btn-primary']) ?>

        </div>
    </div>
<?php ActiveForm::end() ?>