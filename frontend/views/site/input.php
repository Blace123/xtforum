<?php
/* @var $this yii\web\View */
$this->title = '发表新帖';
use \yii\helpers\Html;
use \yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use frontend\models\UserdataForm;
?>
<?php
if (!Yii::$app->user->isGuest) {
    $models = new UserdataForm();
    $data = $models->data(Yii::$app->user->identity->id);
}

?>


<section class="xtindex-main">
    <div class="container">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <?php $form = ActiveForm::begin([

                ]); ?>
                <div class="post">

                        <div class="topwrap">
                            <div class="userinfo pull-left">

                                <div class="avatar">
                                    <img src="<?php if(!Yii::$app->user->isGuest){echo $data['image'];}else{echo "../statics/images/person1.jpg";}?>" alt="">
                                    <div class="status green">&nbsp;</div>
                                </div>
                                <div class="icons">
                                    <img src="../statics/images/icon1.jpg" alt=""><img src="../statics/images/icon2.jpg" alt=""><img src="../statics/images/icon3.jpg" alt=""><img src="images/icon4.jpg" alt="">
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <div>
                                    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder'=>'请输入标题名称'])->label('标题') ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                            <?= $form->field($model, 'class')->dropDownList(ArrayHelper::map($plate,'id', 'name'),['prompt' => '请选择一个板块']);?>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                    </div>
                                </div>
                                <div>
                                    <?= $form->field($model, 'content')->textarea(['rows'=>3,'placeholder'=>'在这里发表你的观点~'])->label('内容') ?>
                                </div>
                                <div class="row newtopcheckbox">
                                    <div class="col-lg-6 col-md-6">
                                        <div>
                                            <p>分享到社交</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="fb"> <i class="fa fa-qq"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="tw"> <i class="fa fa-weibo"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="gp"> <i class="fa fa-renren"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfobot">
                            <div class="pull-right postreply">
                                <div class="pull-left">
                                    <?= Html::submitButton('发表', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>


            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-md-8">
                <div class="pull-left">
                    <a href="#" class="prevnext"><i class="material-icons">chevron_left</i></a>
                </div>

                <div class="pull-left">
                    <a href="#" class="prevnext last"><i class="material-icons">chevron_right</i></a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>