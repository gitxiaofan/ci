<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>会员注册_<?php echo $settings['sitename']?></title>
    <meta name="keywords" content="<?php echo $settings['sitekeyword']?>">
    <meta name="description" content="<?php echo $settings['sitedescription']?>">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/home/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/style.css" rel="stylesheet">
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>

</head>

<body class="gray-bg">
<?php include_once('menu.php');?>
<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <div class="logo-content">
                <p>即便身在天涯 / 不敢心忘先祖</p>
                <p>孝从追思始 / 爱在追思续</p>
                <p>辛劳功业 / 可勉后人</p>
                <p>家风精神 / 一脉传承</p>
            </div>
            <!--<h1 class="logo-name">思</h1>-->

        </div>
        <h3>会员注册</h3>
        <form class="m-t" id="reg" action="" method="post">
            <div class="form-group">
                <input type="text" id="mobile" name="mobile" class="form-control" placeholder="请输入手机号" required="">
            </div>
            <div class="form-group">
                <input type="text" id="nickname" name="nickname" class="form-control" placeholder="请输入昵称（建议实名）" required="">
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="请输入密码" required="">
            </div>
            <div class="form-group">
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="请再次输入密码" required="">
            </div>
            <div class="form-group text-left">
                <div class="checkbox i-checks">
                    <label class="no-padding">
                        <input id="readme" name="readme" type="checkbox"><i></i> 已阅读并同意《<a href="<?php echo site_url('page/detail'). '?id='.$settings['readme']?>" target="_blank">用户使用协议</a>》</label>
                </div>
            </div>
            <?php if(!empty($data['error']['status'])):?>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo $data['error']['message']; ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary block full-width m-b">注 册</button>

            <p class="text-muted text-center"><small>已经有账户了？</small><a href="<?php echo site_url('login/index')?>">点此登录</a>
            </p>

        </form>

    </div>
</div>

<!-- 全局js -->
<script src="<?php echo base_url() ?>/assets/home/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/assets/home/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>/assets/home/js/plugins/layer/layer.min.js"></script>

<!-- 自定义js -->
<script src="<?php echo base_url() ?>/assets/home/js/content.js"></script>

<!-- iCheck -->
<script src="<?php echo base_url() ?>/assets/home/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $('.i-checks input').iCheck('check');
    });
</script>

<!-- jQuery Validation plugin javascript-->
<script src="<?php echo base_url() ?>/assets/home/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>/assets/home/js/plugins/validate/messages_zh.min.js"></script>

<script src="<?php echo base_url() ?>/assets/home/js/demo/form-validate-demo.js"></script>

<script>
    $().ready(function() {
        var icon = "<i class='fa fa-times-circle'></i> ";
        $('#reg').validate({
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
                mobile: {
                    number: true,
                    required: true,
                    maxlength: 11,
                    minlength: 11,
                    remote: {
                        url: "<?php echo site_url('login/checkMobile');?>",
                        type: "post",
                        dataType: "json",
                        cache: false,
                        async: false,
                        data: {
                            mobile: function () {
                                return $("#mobile").val();
                            }
                        }
                    }
                },
                readme: {
                    required: true
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
                mobile: {
                    number: icon + "请输入正确格式的手机号码",
                    required: icon + "请输入您的手机号",
                    remote: icon + "此手机号已被注册",
                    maxlength: icon + "请输入11位手机号码",
                    minlength: icon + "请输入11位手机号码"
                },
                readme: {
                    required: icon + "请阅读并勾选用户使用协议",
                }
            }
        });
    });
</script>

</body>

</html>
