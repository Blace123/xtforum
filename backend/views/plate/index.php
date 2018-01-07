<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Plate */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '板块管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建新的板块', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'owner',
            'create_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
