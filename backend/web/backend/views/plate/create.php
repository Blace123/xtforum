<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Plate */

$this->title = 'Create Plate';
$this->params['breadcrumbs'][] = ['label' => 'Plates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
