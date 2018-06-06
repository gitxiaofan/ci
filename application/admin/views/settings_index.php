<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>常规设置 - 追思网</title>

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
                    <h5>常规设置</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="settings" method="post">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">网站地址（URL）：</label>
                            <div class="col-sm-8">
                                <input id="siteurl" name="siteurl" value="<?php echo empty($settings['siteurl']) ? '':$settings['siteurl']; ?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">网站标题：</label>
                            <div class="col-sm-8">
                                <input id="sitename" name="sitename" value="<?php echo empty($settings['sitename']) ? '':$settings['sitename']; ?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">副标题：</label>
                            <div class="col-sm-8">
                                <input id="sitesubtitle" name="sitesubtitle" value="<?php echo empty($settings['sitesubtitle']) ? '':$settings['sitesubtitle']; ?>" class="form-control" type="text">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 用简洁的文字描述本站点，建议字数在32字以内</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">网站关键词：</label>
                            <div class="col-sm-8">
                                <input id="sitekeyword" name="sitekeyword" value="<?php echo empty($settings['sitekeyword']) ? '':$settings['sitekeyword']; ?>" class="form-control" type="text">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 各个关键词用英文逗号（,）隔开，建议关键词10个以内</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">网站描述：</label>
                            <div class="col-sm-8">
                                <textarea id="sitedescription" name="sitedescription" class="form-control"><?php echo empty($settings['sitedescription']) ? '':$settings['sitedescription']; ?></textarea>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 网站描述建议字数100字以内</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">首页幻灯片：</label>
                            <div class="col-sm-8">
                                <select class="form-control m-b" name="homeslider">
                                    <?php foreach($settings['adcats'] as $k => $val): ?>
                                        <option <?php echo empty($settings['homeslider']) ? '' : $k == $settings['homeslider'] ? 'selected':''?> value="<?php echo $k; ?>"><?php echo $val?></option>
                                    <?php endforeach;?>
                                </select>
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


</body>

</html>
