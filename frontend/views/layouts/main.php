<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\bootstrap\Modal;
use frontend\models\UserdataForm;
use backend\models\Info;
use backend\models\Comment;
use backend\models\Userdata;
use frontend\models\SiteSearch;
use yii\widgets\ActiveForm;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php
$models = new SiteSearch();
if (!Yii::$app->user->isGuest) {
    $model = new UserdataForm();
    $data = $model->data(Yii::$app->user->identity->id);
}

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" style="">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">

        <?php
            NavBar::begin([
                'brandLabel' => '晓涛论坛',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/aboutuser']],
                ['label' => 'Contant', 'url' => ['/site/contact']],
            ];

            if (Yii::$app->user->isGuest) {
                ['label' => '登陆', 'url' => ['/login/login']];

            } else {
                $menuItems[] = [
                    'label' => '退出 (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/login/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            ?>
        <div class="avatar pull-left dropdown">
            <li id="top-user-btn">
                <div class="user-headimg"><img src="<?php if(!Yii::$app->user->isGuest){echo $data['image'];}else{echo "../statics/images/person1.jpg";}?>" alt=""><b class="caret"></b></div>
                <div class="dropdown-menu dropMenu pull-right" id="top-user">
                    <div class="lv-header">个人信息</div>
                    <div class="lv-body">
                        <div class="myInfo">
                            <div class="myphoto">
                                <div class="userhead" data-type="update_avatar">
                                    <a href="/site/aboutuser" style="display:block;">
                                        <img src="<?php if(!Yii::$app->user->isGuest){echo $data['image'];}else{echo "../statics/images/person1.jpg";}?>" alt="" width="96" height="96">
                                    </a>
                                </div>
                            </div>

                            <div class="myshow">
                                <div class="myname"><?php if(!Yii::$app->user->isGuest){echo Yii::$app->user->identity->username;}else{echo "您还未登陆，请登陆";}?></div>
                                <div class="Email"><?php if(!Yii::$app->user->isGuest){echo $data['email'];}else{echo "";}?></div>
                                <div class="signature"><?php if(!Yii::$app->user->isGuest){echo "普通用户";}else{echo "";}?></div>
                                <?php if(!Yii::$app->user->isGuest){?>
                                    <a class="btn user-myprofile" href="/site/aboutuser">管理我的账户</a>
                                <?php }else{?>
                                <a class="btn user-myprofile" href="/login/login">点击登陆</a>
                                <?php }?>
                            </div>
                        </div>

                            <div style="overflow: hidden;"></div>
                    </div>
                </div>
                <!--dropdown-menu end-->
            </li>
        </div>
<?php
$js=<<<JS
function abc(){
    alert("sd");
/*event.preventDefault(); 
$.post("/login/logout", function(json) {
});*/
}
JS;
$this->registerJs($js);
?>


        <?php
            NavBar::end();
        ?>
        <div class="container">

        <div class="xttop">
            <div class="xttop-headernav">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2">
                            <a href="/site/index"><img src="../statics/images/logo.jpg"></a>
                        </div>
                        <div class="col-lg-3 col-xs-9 col-sm-5 col-md-3 selecttopic">
                            <div class="dropdown">
                                <a href="/site/index">返回首页</a> <b class="caret"></b>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">类型1</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-2" href="#">类型2</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-3" href="#">类型3</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
                            <div class="wrap">
                                <?php $form = ActiveForm::begin([]);?>
                                    <div class="pull-left txt">
                                        <?= $form->field($models, 'content')->textInput(['maxlength' => true,'placeholder'=>'请输入您要搜索的内容'])->label(false) ?>
                                    </div>
                                    <div class="pull-right">

                                        <i class="material-icons"> <?= Html::submitButton('search', ['class' => 'btn btn-default', 'name' => 'login-button']) ?></i>

                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt">
                            <div class="stnt pull-left">
                                    <a href="/site/input">
                                    <button class="btn btn-primary">开始创建新的话题</button>
                                    </a>
                            </div>
                            <div class="env pull-left">
                                <li class="dropdown" id="info-btn">
                                    <a href="javascript:void(0);"><i class="material-icons">mail</i></a>
                                    <div class="dropdown-menu dropMenu pull-right" id="info">
                                        <div class="lv-header">消息提醒</div>
                                        <div class="lv-body">
                                            <?php
                                            if(!Yii::$app->user->isGuest){
                                                $id= Yii::$app->user->identity->id;
                                                $info = Info::find()->where(['user_id'=>$id])->asArray()->all();
                                                foreach ($info as $item){
                                                    $comment = Comment::find()->where(['info_id'=>$item['id']])->andWhere(['<>','user_id',$id])->orderBy('create_at DESC')->asArray()->ALL();
                                                    foreach ($comment as $items) {
                                                        $userdata = Userdata::find()->where(['user_id' => $items['user_id']])->asArray()->one();?>
                                                    <a class="lv-item" href="/site/view?info_id=<?php echo $item['id']?>">
                                                        <div class="media">
                                                            <div class="pull-left">
                                                                <img class="lv-img-sm" src="<?php if($userdata['image']){echo $userdata['image'];}else{echo "../statics/images/person1.jpg";}?>" alt="">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="lv-title"><?php if($userdata['name']){echo $userdata['name'];}else{echo "陌生人";}?></div>
                                                                <small class="lv-small"><?php echo $items['content'] ?></small>
                                                            </div>
                                                        </div>
                                                    </a >
                                                <?php
                                                    }}}else{ ?>
                                                <a class="lv-item" href="/login/login">
                                                    <div class="media">
                                                        <div class="pull-left">
                                                            <img class="lv-img-sm" src="<?php echo "../statics/images/person1.jpg"?>" alt="">
                                                        </div>

                                                        <div class="media-body">
                                                            <div class="lv-title">Hi~亲</div>
                                                            <small class="lv-small"><?php echo "您还未登陆，点击登陆查看" ?></small>
                                                        </div>
                                                    </div>
                                                </a >
                                            <?php }?>
                                        </div>
                                        <div style="overflow: hidden;"><a class="lv-footer" href="javascript:void(0);">全部已读</a></div>
                                    </div>
                                    <!--dropdown-menu end-->
                                </li>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    </div>
 <!--   <footer class="footer">
        <div class="container">
        <p class="pull-left"> My Company </p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-xs-3 col-sm-2 logo "><a href="#"><img src='../statics/images/logo.jpg' alt=""></a></div>
                <div class="col-lg-8 col-xs-9 col-sm-5 ">&copy;Copyrights <?= date('Y') ?>, xtforum.com</div>
                <div class="col-lg-3 col-xs-12 col-sm-5 sociconcent">
                    <ul class="socialicons">
                        <li><a href="#"><i class="fa fa-github" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-qq"></i></a></li>
                        <li><a href="#"><i class="fa fa-renren"></i></a></li>
                        <li><a href="#"><i class="fa fa-weibo"></i></a></li>
                        <li><a href="#"><i class="fa fa-weixin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>

<?php
Modal::begin([
    'id' => 'common-modal',
    'header' => '<h4 class="modal-title">注册失败</h4>',
    'footer' =>  '<a href="/login/about" class="btn btn-primary" data-dismiss="modal">scs</a>',
]);
echo '<h10>注册失败，请重试</h10>';
Modal::end();
//弹窗?>

<?php
Modal::begin([
    'id' => 'create-modal',
    'header' => '<h4 class="modal-title">忘记密码</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]);
Modal::end();
?>

