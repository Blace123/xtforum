<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Info */

$this->title = Yii::t('app', 'Create Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
