<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>编辑祭品 - 追思网</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<?php
//print_r($sacrifice);
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加/编辑祭品</h5>
                    <div class="ibox-tools">
                        <a href="<?php echo site_url('sacrifice/index')?>">
                            <i class="fa fa-reply"></i> 返回上一页
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="add" method="post" enctype ="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">祭品名称：</label>
                            <div class="col-sm-8">
                                <input id="name" name="name" value="<?php echo empty($sacrifice['name']) ? '':$sacrifice['name']; ?>" class="form-control" type="text">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 祭品名称必须填写</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">上传祭品图片</label>
                            <div class="col-sm-8">
                                <input type="file" name="pic" class="form-control" accept="image/*">
                                <?php if($action =='mod'){?>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 留空是不修改图片</span>
                                <?php }else{ ?>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 上传图片大小最大是2M</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">排序：</label>
                            <div class="col-sm-8">
                                <input id="sort" name="sort" class="form-control" value="<?php echo empty($sacrifice['sort']) ? '':$sacrifice['sort']; ?>" >
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
        $('#add').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 1
                }
            },
            messages: {
                name: {
                    required: icon + "请输入祭品名称",
                    minlength: icon + "祭品名称必须两个字符以上"
                }
            }
        });

    });
</script>


</body>

</html>
