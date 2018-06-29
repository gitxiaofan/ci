<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>找回密码_<?php echo $settings['sitename']?></title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/home/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/home/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">
<?php include_once('menu.php');?>
<div class="middle-box text-center loginscreen  animated fadeInDown">
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
        <h3>找回密码</h3>

        <form class="m-t" role="form" method="post">
            <div class="form-group">
                <div class="input-group">
                    <input id="mobile" name="mobile" type="text" class="form-control" placeholder="手机号" required="">
                    <div class="input-group-btn">
                        <button type="button" id="sendcode" class="btn btn-primary">发送验证码</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input id="verify" name="verify" type="text" class="form-control" placeholder="输入验证码" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">验 证</button>
        </form>
        <?php if(!empty($data['error']['status']) && $data['error']['status'] < 0):?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?php echo $data['error']['message']; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- 全局js -->
<script src="<?php echo base_url() ?>/assets/home/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/assets/home/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>/assets/home/js/plugins/layer/layer.min.js"></script>

<!-- 自定义js -->
<script src="<?php echo base_url() ?>/assets/home/js/content.js"></script>
<script>
    $('#sendcode').click(function(){
        var mobile = $('#mobile').val();
        var _this = $(this);
        $.ajax({
            type: 'post',
            url: '<?php echo site_url('login/checkMobile')?>',
            data: {'mobile': mobile},
            dataType: 'text',
            success: function (data) {
                //console.log(data);
                if(data == 'false'){
                    //发送验证码
                    sendCode(mobile);
                }else{
                    //手机号不存在
                    alert('手机号不存在！');
                }
            }
        });

        function sendCode(mobile){
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('login/sendCode')?>',
                data: {'mobile': mobile},
                dataType: 'text',
                success: function (data) {
                    //console.log(data);
                    if(data == 'true'){
                        //发送成功
                        invokeSettime(_this);
                    }else{
                        //发送失败
                        alert('发送失败，请稍后再试');
                    }
                }
            });
        }

        function invokeSettime(obj){
            var countdown=60;
            settime(obj);
            function settime(obj) {
                if (countdown == 0) {
                    $(obj).attr("disabled",false);
                    $(obj).text("获取验证码");
                    countdown = 60;
                    return;
                } else {
                    $(obj).attr("disabled",true);
                    $(obj).text("(" + countdown + ") s 重新发送");
                    countdown--;
                }
                setTimeout(function() {
                        settime(obj) }
                    ,1000)
            }
        }
    });


</script>

</body>

</html>
