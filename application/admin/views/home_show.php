<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--360浏览器优先以webkit内核解析-->


    <title>仪表盘 - 追思网</title>

    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/admin/favicon.ico">
    <link href="<?php echo base_url() ?>/assets/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/admin/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/style.css?v=4.1.0" rel="stylesheet">


</head>

<body class="gray-bg">
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-12">
        <blockquote class="text-warning" style="font-size:14px">逝去的，虽已消散，记忆依旧存在…
            <br>忘却的是伤痛，不忘的是怀念…
            <br>选择遗忘那伤心的种种，对你的思念永存心头…
            <br>…………
            <h4 class="text-danger">愿生者健康，逝者安息，缅怀过去，祈福未来！</h4>
        </blockquote>

        <hr>
    </div>
    <div class="col-sm-3">
        <h2>Hello,<?php echo $_SESSION['admin']['username']; ?></h2>
        <p>这是网站管理后台，你可以在这里管理编辑网站的各类信息。</p>
    </div>
    <div class="col-sm-5">
    </div>
    <div class="col-sm-4">
    </div>

</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>开发人员联系信息</h5>

                </div>
                <div class="ibox-content">
                    <p><i class="fa fa-home"></i> 官网：<a href="http://www.zhujimiao.com" target="_blank">http://www.zhujimiao.com</a>
                    </p>
                    <p><i class="fa fa-qq"></i> QQ：<a href="http://wpa.qq.com/msgrd?v=3&uin=3312429490&site=qq&menu=yes" target="_blank">3312429490</a>
                    </p>
                    <p><i class="fa fa-weixin"></i> 微信：<a href="javascript:;">xiaofan1625</a>
                    </p>
                    <p><i class="fa fa-send-o"></i> 播客：<a href="http://www.xiaofanblog.com" target="_blank">http://www.xiaofanblog.com</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
        </div>
    </div>
</div>

<!-- 全局js -->
<script src="<?php echo base_url() ?>/assets/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo base_url() ?>/assets/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo base_url() ?>/assets/admin/js/plugins/layer/layer.min.js"></script>

<!-- 自定义js -->
<script src="<?php echo base_url() ?>/assets/admin/js/content.js"></script>

<!-- 欢迎信息 -->
<script src="<?php echo base_url() ?>/assets/admin/js/welcome.js"></script>
</body>

</html>
