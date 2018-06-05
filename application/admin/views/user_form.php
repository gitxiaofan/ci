<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>编辑用户 - 追思网</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加/编辑用户</h5>
                    <div class="ibox-tools">
                        <a href="<?php echo site_url('user/index')?>">
                            <i class="fa fa-reply"></i> 返回上一页
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="user_<?php echo $action; ?>" method="post">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">手机：</label>
                            <div class="col-sm-8">
                                <input id="mobile" name="mobile" value="<?php echo empty($user['mobile']) ? '':$user['mobile']; ?>" class="form-control" type="text">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 手机号是必填的，前台登陆使用</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">密码：</label>
                            <div class="col-sm-8">
                                <input id="password" name="password" class="form-control" type="password">
                                <?php if($action == 'mod'):?><span class="help-block m-b-none"><i class="fa fa-info-circle"></i>留空表示不修改密码</span><?php endif; ?>
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


<!-- 全局js -->
<script src="<?php echo base_url() ?>/assets/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo base_url() ?>/assets/admin/js/bootstrap.min.js?v=3.3.6"></script>

<!-- 自定义js -->
<script src="<?php echo base_url() ?>/assets/admin/js/content.js?v=1.0.0"></script>

<!-- jQuery Validation plugin javascript-->
<script src="<?php echo base_url() ?>/assets/admin/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>/assets/admin/js/plugins/validate/messages_zh.min.js"></script>

<script src="<?php echo base_url() ?>/assets/admin/js/demo/form-validate-demo.js"></script>

<script>
    $().ready(function(){
        var icon = "<i class='fa fa-times-circle'></i> ";
        $('#user_add').validate({
            rules: {
                nickname: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    email: true
                },
                mobile: {
                    number: true,
                    required: true,
                    maxlength: 20,
                    remote: {
                        url: "<?php echo site_url('user/checkMobile');?>",
                        type: "post",
                        dataType: "json",
                        cache: false,
                        async: false,
                        data:{
                            mobile: function(){ return $("#mobile").val(); }
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
                    required: icon + "请输入您的密码",
                    minlength: icon + "密码必须5个字符以上"
                },
                confirm_password: {
                    required: icon + "请再次输入密码",
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

        $('#user_mod').validate({
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
                            id : "<?php echo empty($id) ? 0 : $id?>"
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


</body>

</html>
