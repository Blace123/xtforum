<?php
use yii\helpers\Html;
use backend\models\Info;
use backend\models\Comment;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
$this->title = '晓涛论坛';
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
                  
           $("#users").on("click", function(e){

            e = e||event;
            $("#top-users").toggleClass("show-info");
           
            $("#top-users").on("click", function(e){
                e.stopPropagation();
         
            })
            e.stopPropagation();

            $(document).one("click", function(e){
              $("#top-users").removeClass("show-info");
        
              e.stopPropagation();
            })
          })


JS;
$this->registerJs($js);
?>
<section class="xtindex-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-md-8">

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <?php for($i=0;$i<count($info);$i++){?>
                <div class="post">
                    <div class="wrap-ut pull-left">
                        <div class="userinfo pull-left">
                            <div class="avatar" id="#">
                                <?php $uid=$info[$i]['user_id'];
                               $model = Info::find()->where(['id' =>$info[$i]['id']])->one();
                               $user= $model->getuser();
                                ?>
                                <a href="/site/userinfo?userid=<?php echo $uid?>">
                                <img src="<?php if($user['image']){echo $user['image'];}
                                else{echo "../statics/images/person1.jpg";}
                                ?>" alt="" >
                                </a>
                            </div>

                            <div class="icons">

                                <?php if($user['user_id']==$owner){echo $platename;}?>
                                <img src="../statics/images/icon1.jpg" alt=""><img src="../statics/images/icon2.jpg" alt="">
                            </div>
                        </div>
                        <div class="posttext pull-left">
                            <h2><a href="/site/view?info_id=<?php echo $info[$i]['id']?>"><?php echo $info[$i]['title']?></a></h2>
                            <p><?php echo $info[$i]['brief']?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="postinfo pull-left">
                        <div class="comments">
                            <div class="commentbg">
                                <?php
                                $id= $info[$i]['id'];
                                $number =count(Comment::find()->where(['info_id'=>$id])->all());
                                echo $number;
                                ?>
                                <div class="mark"></div></div>
                        </div>
                        <div class="views"><i class="material-icons">remove_red_eye</i> 1,568</div>
                        <div class="time"><i class="material-icons">access_time</i> 24 min</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php }?>
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
