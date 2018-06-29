<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>编辑广告 - 追思网</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/admin/css/plugins/simditor/simditor.css" />
    <link href="<?php echo base_url() ?>/assets/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<?php
//print_r($ad);
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加/编辑广告</h5>
                    <div class="ibox-tools">
                        <a href="<?php echo site_url('ad/index')?>">
                            <i class="fa fa-reply"></i> 返回上一页
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="add" method="post" enctype ="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">广告标题：</label>
                            <div class="col-sm-8">
                                <input id="title" name="title" value="<?php echo empty($ad['title']) ? '':$ad['title']; ?>" class="form-control" type="text">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 广告标题必须填写</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">上传广告图片：</label>
                            <div class="col-sm-8">
                                <input type="file" name="pic" class="form-control" accept="image/*">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?php echo $action =='mod' ? '留空是不修改图片，':''?>上传图片大小最大是2M，建议尺寸600*400</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">分类：</label>
                            <div class="col-sm-8">
                                <select class="form-control m-b" name="cat_id">
                                    <?php foreach($adcats as $k => $val): ?>
                                    <option <?php echo empty($ad['cat_id']) ? '' : $k == $ad['cat_id'] ? 'selected':''?> value="<?php echo $k; ?>"><?php echo $val?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">跳转链接：</label>
                            <div class="col-sm-8">
                                <input id="link" name="link" value="<?php echo empty($ad['link']) ? '':$ad['link']; ?>" class="form-control" type="text">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>填写点击图片跳转的网址</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">排序：</label>
                            <div class="col-sm-8">
                                <input id="sort" name="sort" class="form-control" value="<?php echo isset($ad['sort']) ? $ad['sort']:''; ?>" >
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
                title: {
                    required: true,
                    minlength: 1
                }
            },
            messages: {
                title: {
                    required: icon + "请输入广告名称",
                    minlength: icon + "广告名称必须一个字符以上"
                }
            }
        });

    });
</script>


</body>

</html>
