<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['login/reset-password', 'token' => $user->password_reset_token]);
?>

Hello <?= Html::encode($user->username) ?>,

请点击下面的链接重新设置您的密码:

<?= Html::a(Html::encode($resetLink), $resetLink) ?>
