<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 表单验证 jQuery Validation</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/admin/css/plugins/simditor/simditor.css" />
    <link href="<?php echo base_url() ?>/assets/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加/编辑纪念馆</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_basic.html#">选项1</a>
                            </li>
                            <li><a href="form_basic.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="admin_<?php echo $action; ?>" method="post">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">纪念人姓名：</label>
                            <div class="col-sm-8">
                                <input id="name" name="name" value="<?php echo empty($memorial['name']) ? '':$memorial['name']; ?>" class="form-control" type="text">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 纪念人姓名必须填写</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">生日：</label>
                            <div class="col-sm-8">
                                <input id="birthday" name="birthday" class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">忌日：</label>
                            <div class="col-sm-8">
                                <input id="death" name="death" class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">墓志铭：</label>
                            <div class="col-sm-8">
                                <textarea id="epitaph" name="epitaph" class="form-control" rows="3"><?php echo empty($memorial['epitaph']) ? '':$memorial['epitaph']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否突出显示：</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" name="is_strong" value="1"> 是
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="is_strong" value="0"> 否
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否置顶：</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" name="stick" value="1"> 是
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="stick" value="0"> 否
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">纪事：</label>
                            <div class="col-sm-8">
                                <textarea name="content" id="editor" placeholder="这里输入内容"></textarea>
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
        $('#admin_add').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 1
                }
            },
            messages: {
                name: {
                    required: icon + "请输入您的姓名/昵称",
                    minlength: icon + "姓名/昵称必须两个字符以上"
                }
        });

    });
</script>

<!-- layerDate plugin javascript -->
<script src="<?php echo base_url() ?>/assets/admin/js/plugins/layer/laydate/laydate.js"></script>

<!-- simditor -->
<script type="text/javascript" src="<?php echo base_url() ?>/assets/admin/js/plugins/simditor/module.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/admin/js/plugins/simditor/uploader.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/admin/js/plugins/simditor/hotkeys.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/admin/js/plugins/simditor/simditor.js"></script>
<script>
    $(document).ready(function () {
        var editor = new Simditor({
            textarea: $('#editor'),
            defaultImage: 'img/a9.jpg'
        });
    });
</script>


</body>

</html>
