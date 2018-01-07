<?php
use yii\helpers\Html;
use hyii2\avatar\AvatarWidget;
use yii\widgets\ActiveForm;
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

<div id="main" style="background-color: #ecf0f1;">
    <div class="container">
        <div class="block-header">
        </div>
        <div class="myContainer">
            <div class="myProfile-header c-shadow" id="crop-avatar">
                <div class="banner"></div>
                <div class="avatar-view myProfile-img-div">
                    <?= \hyii2\avatar\AvatarWidget::widget(['imageUrl'=>$data['image']]); ?>

                </div>
                <!--myProfile-img-div end-->
                <div class="myProfile-name"><?php if($data['name']){echo $data['name'];}else{echo Yii::$app->user->identity->username;}?></div>
            </div>
            <!--myProfile-header end-->
            <div class="col-md-6 col-sm-6 pd8">
                <div class="card myProfile-card c-shadow">

                        <div class="card-header">
                            <h5><i class="material-icons">account_circle</i><span>信息认证</span></h5>
                        </div>
                        <!--card-header end-->
                        <div class="card-body">
                            <p>
                                <label>Q Q：</label>
                                <span><?php if($data['qq']){echo $data['qq'];}else{ echo" 暂未填写QQ号码";}?></span>
                            </p>
                            <p>
                                <label>手机：</label>
                                <span><?php if($data['phone']){echo $data['phone'];}else{ echo"暂未填写手机号码";}?></span>
                            </p>
                            <p>
                                <label>邮箱：</label>
                                <span><?php if($data['email']){echo $data['email'];}else{ echo"暂未填写电子邮箱";}?></span>
                            </p>
                        </div>

                        <!--card-body end-->
                


                </div>
                <!--card end-->
                <!-- 初始状态 -->
                <!--card end-->
                <!--card end-->
                <div class="card myProfile-card c-shadow">
                    <form action="">
                        <div class="card-header">
                            <h5><i class="material-icons">assignment</i><span>基本信息</span></h5>
                        </div>
                        <!--card-header end-->
                        <div class="card-body">
                            <p>
                                <label>昵称：</label>
                                <span><?php if($data['name']){echo $data['name'];}else{ echo"暂未填写昵称";}?></span>
                            </p>
                            <p>
                                <label>地址：</label>
                                <span><?php if($data['address']){echo $data['address'];}else{ echo"暂未填写地址";}?></span>
                            </p>

                            <p>
                                <label>性别：</label>
                                <span><?php if($data['sex']){echo $data['sex'];}else{ echo"暂未选择性别";}?></span>
                            </p>
                            <p>
                                <label>生日：</label>
                                <span><?php if($data['birthday']){echo $data['birthday'];}else{ echo"暂未填写生日";}?></span>
                            </p>
                            <p>
                                <label>爱好：</label>
                                <span><?php if($data['hobby']){echo $data['hobby'];}else{ echo"暂未填写爱好";}?></span>
                            </p>
                            <p>
                                <label>宣言：</label>
                                <span><?php if($data['motto']){echo $data['motto'];}else{ echo"暂未填写个人留言";}?></span>
                            </p>
                        </div>
                        <!--card-body end-->
                    </form>
                </div>
                <!-- 修改密码 -->
                <div class="card myProfile-card c-shadow">
                    <div class="card-header">
                        <h5><i class="material-icons">lock_open</i><span><a href="/login/requestpassword">修改密码</a></span></h5>
                    </div>
                    <!--card-header end-->

                    <!--card-body end-->





                </div>
            </div>
            <!--col-md-6 end-->
                <div class="col-md-6 col-sm-6 pd8">

                <!--card end-->
                <!-- 初始状态 -->
                <div class="card myProfile-card c-shadow">

                    <?php $form = ActiveForm::begin([
                        'options' =>['class' => 'form-body myProfile_validate change_password'],
                        'method'=>'post'

                    ]); ?>
                        <div class="card-header">
                            <h5><i class="material-icons">assignment</i><span>信息修改
                                </span></h5>
                        </div>
                        <!--card-header end-->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="QQ" class="col-md-2 col-sm-2 col-xs-2 control-label plr0">Q Q：</label>
                                <div class="col-md-10 col-sm-10 col-xs-10 plr0">
                                    <?= $form->field($model, 'qq')->textInput(['maxlength' => true,'placeholder'=>$data['qq']])->label(false) ?>
                                </div>
                            </div>
                            <!--form-group end-->
                            <div class="form-group row">
                                <label for="phone" class="col-md-2 col-sm-2 col-xs-2 control-label plr0">手机：</label>
                                <div class="col-md-10 col-sm-10 col-xs-10 plr0">
                                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'placeholder'=>$data['phone']])->label(false) ?>
                                </div>
                            </div>
                            <!--form-group end-->
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-sm-2 col-xs-2 control-label plr0">邮箱：</label>
                                <div class="col-md-10 col-sm-10 col-xs-10 plr0">
                                    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder'=>$data['email']])->label(false) ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-2 col-sm-2 col-xs-2 control-label plr0">地址：</label>
                                <div class="col-md-10 col-sm-10 col-xs-10 plr0">
                                    <?= $form->field($model, 'address')->textInput(['maxlength' => true,'placeholder'=>$data['address']])->label(false) ?>
                                </div>
                            </div>
                            <!--form-group end-->
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-sm-2 col-xs-2 control-label plr0">昵称：</label>
                                <div class="col-md-10 col-sm-10 col-xs-10 plr0">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>$data['name']])->label(false) ?>
                                </div>
                            </div>
                            <!--form-group end-->
                            <div class="form-group row">
                                <label class="col-md-2 col-sm-2 col-xs-2 control-label plr0">性别：</label>
                                <div class="col-md-10 col-sm-10 col-xs-10 plr0">
                                    <?= $form->field($model, 'sex')->radioList(['男'=>'男','女'=>'女'])->label(false) ?>

                                    <!--radio end-->
                                </div>
                            </div>
                            <!--form-group end-->
                            <div class="form-group row">
                                <label for="birth" class="col-md-2 col-sm-2 col-xs-2 control-label plr0">生日：</label>
                                <div class="col-md-10 col-sm-10 col-xs-10 plr0">
                                    <?= $form->field($model, 'birthday')->textInput(['maxlength' => true,'placeholder'=>$data['birthday']])->label(false) ?>
                                </div>
                            </div>
                            <!--form-group end-->
                            <div class="form-group row">
                                <label for="hobby" class="col-md-2 col-sm-2 col-xs-2 control-label plr0">爱好：</label>
                                <div class="col-md-10 col-sm-10 col-xs-10 plr0">
                                    <?= $form->field($model, 'hobby')->textInput(['maxlength' => true,'placeholder'=>$data['hobby']])->label(false) ?>
                                </div>
                            </div>
                            <!--form-group end-->
                            <div class="form-group row">
                                <label for="sign" class="col-md-2 col-sm-2 col-xs-2 control-label plr0">宣言：</label>
                                <div class="col-md-10 col-sm-10 col-xs-10 plr0">
                                    <?= $form->field($model, 'motto')->textarea(['rows'=>3,'placeholder'=> $data['motto']])->label(false) ?>
                                    <span class="help-block">个性签名</span>
                                </div>
                            </div>
                            <!--form-group end-->
                        </div>
                        <!--card-body end-->
                        <div class="button-label">
                            <button type="reset" class="btn join-cancel currency-form-close">取消</button>
                            <?= Html::submitButton('保存', ['class' => 'btn join-party', 'name' => 'btn join-party']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <!--card end-->
            </div>
            <!--col-md-6 end-->
        </div>
        <!--myContainer end-->
    </div>
    <!--container end-->
    <!--change_head_img alert-->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form" action="{{url('admin/upload-logo')}}" enctype="multipart/form-data" method="post">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">更改头像</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <label for="avatarInput">图片上传</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
                            <div class="row avatar-btns">
                                <div class="col-md-9">
                                    <div class="btn-group">
                                        <button class="btn" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"><i class="fa fa-undo"></i> 向左旋转</button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"><i class="fa fa-repeat"></i> 向右旋转</button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success btn-block avatar-save" type="submit"><i class="fa fa-save"></i> 保存修改</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
