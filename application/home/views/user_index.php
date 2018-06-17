<?php
$user = $data['user'];
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>修改账户信息_<?php echo $settings['sitename']?></title>
    <meta name="keywords" content="<?php echo $settings['sitekeyword']?>">
    <meta name="description" content="<?php echo $settings['sitedescription']?>">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/home/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/home/css/plugins/simditor/simditor.css" />
    <link href="<?php echo base_url() ?>/assets/home/css/style.css" rel="stylesheet">

    <!--远程字体库-->
    <script type="text/javascript" src="http://cdn.webfont.youziku.com/wwwroot/js/wf/youziku.api.min.js"></script>
    <script type="text/javascript">
        $youziku.load("body", "6c0c14d3d2da4029bee76c045e977fca", "hdjlibian");
        $youziku.draw();
    </script>
</head>

<body class="detail-bg">
<?php include_once('menu.php');?>
<div class="memorial-form animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>修改账户信息</h5>
                    <div class="ibox-tools">
                        <a href="javascript:history.back(-1)">
                            <i class="fa fa-reply"></i> 返回上一页
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="mod" method="post">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">手机号：</label>
                            <div class="col-sm-8">
                                <input id="mobile" name="mobile" value="<?php echo $user['mobile'] ?>" class="form-control" type="text">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 手机号必须填写</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">密码：</label>
                            <div class="col-sm-8">
                                <input id="password" name="password" class="form-control" type="password">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>留空表示不修改密码</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">确认密码：</label>
                            <div class="col-sm-8">
                                <input id="confirm_password" name="confirm_password" class="form-control" type="password">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请再次输入您的密码</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">姓名/昵称：</label>
                            <div class="col-sm-8">
                                <input id="nickname" name="nickname" value="<?php echo empty($user['nickname']) ? '':$user['nickname']; ?>" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 姓名/昵称是必填的</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">E-mail：</label>
                            <div class="col-sm-8">
                                <input id="email" name="email" value="<?php echo empty($user['email']) ? '':$user['email']; ?>" class="form-control" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">头像：</label>
                            <div class="col-sm-8">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#picModal">
                                    <i class="fa fa-plus"></i> <?php echo empty($user['avater']) ? '添加':'修改' ?>头像
                                </button>
                                <div id="memorial-pic" class="row">
                                    <?php if(!empty($user['avater'])):?>
                                        <div class="user-pic" id="user-pic">
                                            <div class="col-xs-6">
                                                <img src="<?php echo base_url(). $user['avater']?>">
                                                <input type="hidden" name="avater" value="<?php echo $user['avater']?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal inmodal" id="picModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                </button>
                <div class="btn-group">
                    <label title="上传图片" for="inputImage" class="btn btn-info">
                        <input type="file" accept="image/*" name="file" id="inputImage" class="hide"> 选择本地图片
                    </label>
                </div>
            </div>
            <div class="modal-body">
                <div class="image-crop">
                    <img src="<?php echo base_url() ?>/assets/home/img/avater.jpg">
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <button class="btn btn-white" id="zoomIn" type="button">放大</button>
                    <button class="btn btn-white" id="zoomOut" type="button">缩小</button>
                    <button class="btn btn-white" id="rotateLeft" type="button">左旋转</button>
                    <button class="btn btn-white" id="rotateRight" type="button">右旋转</button>
                    <button class="btn btn-primary" id="download" type="button">裁剪上传</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 全局js -->
<script src="<?php echo base_url() ?>/assets/home/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/assets/home/js/bootstrap.min.js"></script>

<!-- 自定义js -->
<script src="<?php echo base_url() ?>/assets/home/js/content.js"></script>

<!-- jQuery Validation plugin javascript-->
<script src="<?php echo base_url() ?>/assets/home/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>/assets/home/js/plugins/validate/messages_zh.min.js"></script>

<script src="<?php echo base_url() ?>/assets/home/js/demo/form-validate-demo.js"></script>

<script>
    $().ready(function(){
        var icon = "<i class='fa fa-times-circle'></i> ";
        $('#mod').validate({
            rules: {
                nickname: {
                    required: true,
                    minlength: 2
                },
                password: {
                    minlength: 5
                },
                confirm_password: {
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    email: true
                },
                mobile: {
                    number: true,
                    maxlength: 20,
                    remote: {
                        url: "<?php echo site_url('user/checkMobile');?>",
                        type: "post",
                        dataType: "json",
                        cache: false,
                        async: false,
                        data:{
                            mobile: function(){ return $("#mobile").val(); },
                            id : "<?php echo empty($user['user_id']) ? 0 : $user['user_id']?>"
                        }
                    }
                }
            },
            messages: {
                nickname: {
                    required: icon + "请输入您的姓名/昵称",
                    minlength: icon + "姓名/昵称必须两个字符以上"
                },
                password: {
                    minlength: icon + "密码必须5个字符以上"
                },
                confirm_password: {
                    minlength: icon + "密码必须5个字符以上",
                    equalTo: icon + "两次输入的密码不一致"
                },
                email: icon + "请输入正确格式的E-mail",
                mobile: {
                    number: icon + "请输入正确格式的手机号码",
                    required: icon + "请输入您的手机号",
                    remote : icon + "此手机号已被注册"
                }
            }
        });
    });
</script>


<!-- Image cropper -->
<script src="<?php echo base_url() ?>/assets/home/js/plugins/cropper/cropper.min.js"></script>

<script>
    $(document).ready(function () {

        var $image = $(".image-crop > img")
        $($image).cropper({
            aspectRatio: 1,
            //preview: ".img-preview",
            done: function (data) {
                // 输出结果
            }
        });

        var $inputImage = $("#inputImage");
        if (window.FileReader) {
            $inputImage.change(function () {
                var fileReader = new FileReader(),
                    files = this.files,
                    file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("请选择图片文件");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#download").click(function () {
            var img64 = $image.cropper("getDataURL");
            $.post('<?php echo site_url('user/avater'); ?>',{img:img64},function(res){
                console.log(res);
                var obj = JSON.parse(res);
                if(obj.status == 1){
                    $('.close').click();
                    var pichtml = '<div class="user-pic" id="user-pic">\n' +
                        '<div class="col-xs-6">\n' +
                        '<img src="<?php echo base_url()?>' + obj.pic + '">\n' +
                        '<input type="hidden" name="avater" value="' + obj.pic + '">\n' +
                        '</div>\n' +
                        '</div>';
                    if(<?php echo empty($user['avater']) ? 'false':'true'?>){
                        $('#user-pic').remove;
                    }
                    $('#memorial-pic').append(pichtml);
                }else{
                    alert(obj.message);
                }
            });
        });

        $("#zoomIn").click(function () {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function () {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function () {
            $image.cropper("rotate", 90);
        });

        $("#rotateRight").click(function () {
            $image.cropper("rotate", -90);
        });

        $("#setDrag").click(function () {
            $image.cropper("setDragMode", "crop");
        });

    });
</script>

<script>
    $('body').on('click','.deletepic',function(){
        $(this).parent().remove();
    });
</script>

</body>

</html>
