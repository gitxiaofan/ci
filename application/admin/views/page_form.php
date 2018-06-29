<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>编辑页面 - 追思网</title>
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
                    <h5>添加/编辑页面</h5>
                    <div class="ibox-tools">
                        <a href="<?php echo site_url('page/index')?>">
                            <i class="fa fa-reply"></i> 返回上一页
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="add" method="post">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input id="title" name="title" placeholder="请输入页面标题" value="<?php echo empty($page['title']) ? '':$page['title']; ?>" class="form-control" type="text">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 页面标题必须填写</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea name="content" id="editor" placeholder="这里输入内容"><?php echo empty($page['content']) ? '':$page['content']?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
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
        $('#add').validate({
            rules: {
                title: {
                    required: true,
                    minlength: 1
                }
            },
            messages: {
                title: {
                    required: icon + "请输入您的姓名/昵称",
                    minlength: icon + "姓名/昵称必须两个字符以上"
                }
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
            defaultImage: '<?php echo base_url() ?>/assets/admin/img/a9.jpg',
            placeholder : '这里输入内容...',
            pasteImage: true,
            toolbarFloat:true,
            toolbar : toolbar,  //工具栏
            upload : {
                url : '<?php echo site_url('page/upload_img')?>', //文件上传的接口地址
                params: '', //键值对,指定文件上传接口的额外参数,上传的时候随文件一起提交
                fileKey: 'file', //服务器端获取文件数据的参数名
                connectionCount: 3,
                leaveConfirm: '正在上传文件'
            }
        });
    });
</script>


</body>

</html>
