<?php
use yii\helpers\Html;
use hyii2\avatar\AvatarWidget;
use yii\widgets\ActiveForm;
use backend\models\Userdata;
use backend\models\User;
use yii\widgets\LinkPager;
use backend\models\Info;
/* @var $this yii\web\View */
$this->title = '个人信息';

?>
<?php
$js =<<<JS
    $("#info-btn").on("click", function(e){
    e = e||event;
    $("#info").toggleClass("show-info");
    $("#info").on("click", function(e){e.stopPropagation();})
    e.stopPropagation();
    $(document).one("click", function(e){
      $("#info").removeClass("show-info");
      e.stopPropagation();
    })
  })
        $("#top-user-btn").on("click", function(e){
            e = e||event;
            $("#top-user").toggleClass("show-info");
            $("#top-user").on("click", function(e){
                e.stopPropagation();
         
            })
            e.stopPropagation();

            $(document).one("click", function(e){
              $("#top-user").removeClass("show-info");
        
              e.stopPropagation();
            })
          })
JS;
$this->registerJs($js);
?>
<div class="xttop">
    <div class="xttop-banner">
        <img src="../statics/images/banner.jpg">
    </div>

</div>
<section class="xtindex-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 breadcrumbf">
                <a href="#">类型2</a>
                <span class="diviver">&gt;</span>
                <a href="#">新话题</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="post beforepagination">
                    <div class="topwrap">
                        <div class="userinfo pull-left">
                            <div class="avatar">
                                <?php $id=$info['user_id'];
                                $user = Userdata::find()->where(['user_id'=>$id])->asArray()->one();
                                ?>
                                <img src="<?php echo $user['image']?>" alt="">
                                <div class="status green">&nbsp;</div>
                            </div>
                            <div class="icons">
                                <div class="ht_louzhu">楼主</div>
                                <img class="pull-left" src="../statics/images/icon1.jpg"  alt="">
                                <img class="pull-left" src="../statics/images/icon2.jpg"  alt="">
                            </div>
                        </div>
                        <div class="posttext pull-left">
                            <h2><?php echo $info['title']?></h2>
                            <p><?php echo $info['content']?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="postinfobot">
                        <div class="likeblock pull-left">
                            <a href="#" class="up"><i class="fa fa-thumbs-o-up"></i>25</a>
                            <a href="#" class="down"><i class="fa fa-thumbs-o-down"></i>3</a>
                        </div>
                        <div class="posted pull-left">
                            <i class="fa fa-clock-o"></i> 创建于 : <?php echo $info['create_at']?>
                        </div>
                        <div class="next pull-right">
                            <a href="#"><i class="fa fa-share"></i></a>
                            <a href="#"><i class="fa fa-flag"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php foreach ($comment as $item){?>
                    <div class="post">
                        <div class="topwrap">
                            <div class="userinfo pull-left">
                                <div class="avatar">
                                    <?php $uid=$item['user_id'];
                                    $user = Userdata::find()->where(['user_id'=>$uid])->asArray()->one();
                                    $username = User::find()->where(['id'=>$uid])->asArray()->one();
                                    ?>
                                    <a href="/site/userinfo?userid=<?php echo $uid?>">
                                    <img src="<?php echo $user['image']?>" alt=""  >
                                    </a>

<!--                                    --><?php //if($user['name']){echo $user['name'];}else{echo $username['username'];
//                                    }?>
                                </div>
                                <div class="icons">
                                    <?php if($uid == $infouser){echo $lz;}?>
                                    <img class="pull-left" src="../statics/images/icon1.jpg" alt="">
                                    <img class="pull-left" src="../statics/images/icon2.jpg" alt="">
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <p><?php echo $item['content']?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfobot">
                            <div class="likeblock pull-left">
                                <a href="#" class="up"><i class="fa fa-thumbs-o-up"></i>10</a>
                                <a href="#" class="down"><i class="fa fa-thumbs-o-down"></i>1</a>
                            </div>
                            <div class="posted pull-left"><i class="fa fa-clock-o"></i> 回复于  : <?php echo $item['create_at']?></div>
                            <div class="next pull-right">
                                <a href="#"><i class="fa fa-share"></i></a>
                                <a href="#"><i class="fa fa-flag"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php }?>


                <div class="post">
                    <?php $form = ActiveForm::begin([

                    ]); ?>
                        <div class="topwrap">
                            <div class="userinfo pull-left">
                                <div class="avatar">
                                    <img src="<?php if(!Yii::$app->user->isGuest){echo $data['image'];}else{echo "../statics/images/person.jpg";}?>" alt="" height="37" width="37">

                                </div>
                                <div class="icons">
                                    <img class="pull-left" src="../statics/images/icon1.jpg" alt="">
                                    <img class="pull-left" src="../statics/images/icon2.jpg" alt="">
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <div class="textwraper">
                                    <div class="postreply">发表你的回复</div>
                                    <?= $form->field($model, 'content')->textarea(['rows'=>3,'placeholder'=>'在这里写下你的回复~'])->label(false) ?>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfobot">

                            <div class="pull-right postreply">
                                <div class="pull-left smile"><a href="#"><i class="fa fa-smile-o"></i></a></div>
                                <div class="pull-left"><button type="submit" class="btn btn-primary">发布</button></div>
                                <div class="clearfix"></div>
                            </div>


                            <div class="clearfix"></div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="sidebarblock">
                    <a href="/site/index"><h3>分类</h3></a>
                    <div class="divline"></div>
                    <div class="blocktxt">
                        <ul class="cats">
                            <li ><a href="/site/index">全部</a></li>
                            <?php foreach ($plate as $item){ ?>
                            <li><a href="/site/index?class_id=<?php echo $item['id']?>"><?php echo $item['name']?><span class="badge pull-right">
                                        <?php echo count(Info::find()->where(['class'=>$item['id']])->all())?></span></a></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
                <div class="sidebarblock">
                    <h3>本周投票</h3>
                    <div class="divline"></div>
                    <div class="blocktxt">
                        <p>你最喜欢的运动是什么？</p>
                        <form action="#" method="post" class="form">
                            <table class="poll">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar color1" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 90%">篮球</div>
                                        </div>
                                    </td>
                                    <td class="chbox">
                                        <input id="opt1" type="radio" name="opt" value="1">
                                        <label for="opt1"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar color2" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 63%">羽毛球</div>
                                        </div>
                                    </td>
                                    <td class="chbox">
                                        <input id="opt2" type="radio" name="opt" value="2" checked="">
                                        <label for="opt2"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar color3" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 75%">乒乓球</div>
                                        </div>
                                    </td>
                                    <td class="chbox">
                                        <input id="opt3" type="radio" name="opt" value="3">
                                        <label for="opt3"></label>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                        <p class="smal">投票于一月七日结束</p>
                    </div>
                </div>
                <div class="sidebarblock">
                    <h3>24小时热帖排行</h3>
                    <div class="divline"></div>
                    <div class="blocktxt">
                        <ul class="cats">
                            <li><a href="#">黄焖鸡进军美国市场<span class="badge pull-right">474</span></a></li>
                            <li><a href="#">林雯天胜荣膺中国百强优秀企业<span class="badge pull-right">442</span></a></li>
                            <li><a href="#">遵纪守法，发挥领导干部带头示范作用<span class="badge pull-right">395</span></a></li>
                            <li><a href="#">自觉争做“四个表率” 深入推进“两学一做”<span class="badge pull-right">362</span></a></li>
                            <li><a href="#">法治才能兴中国<span class="badge pull-right">325</span></a></li>
                            <li><a href="#">黄焖鸡进军美国市场<span class="badge pull-right">297</span></a></li>
                            <li><a href="#">林雯天胜荣膺中国百强优秀企业<span class="badge pull-right">261</span></a></li>
                            <li><a href="#">遵纪守法，发挥领导干部带头示范作用<span class="badge pull-right">229</span></a></li>
                            <li><a href="#">自觉争做“四个表率” 深入推进“两学一做”<span class="badge pull-right">189</span></a></li>
                            <li><a href="#">法治才能兴中国<span class="badge pull-right">132</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-md-8">

                <div class="pull-left">
                    <!--   <ul class="paginationforum"> -->
                    <?= LinkPager::widget(['pagination' => $pages,
                        //'options' =>['class' => 'hidden-xs'],
                    ]); ?>
                    <!--    </ul>-->

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>