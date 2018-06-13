<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>编辑纪念馆_<?php echo $settings['sitename']?></title>
    <meta name="keywords" content="<?php echo $settings['sitekeyword']?>">
    <meta name="description" content="<?php echo $settings['sitedescription']?>">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/home/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/home/css/plugins/simditor/simditor.css" />
    <link href="<?php echo base_url() ?>/assets/home/css/style.css" rel="stylesheet">

</head>

<body class="detail-bg">
<?php include_once('menu.php');?>
<div class="memorial-form animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加/编辑纪念馆</h5>
                    <div class="ibox-tools">
                        <a href="javascript:history.back(-1)">
                            <i class="fa fa-reply"></i> 返回上一页
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="add" method="post">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">纪念人姓名：</label>
                            <div class="col-sm-8">
                                <input id="name" name="name" value="<?php echo empty($memorial['name']) ? '':$memorial['name']; ?>" class="form-control" type="text">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 纪念人姓名必须填写</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">简介：</label>
                            <div class="col-sm-8">
                                <textarea id="brief" name="brief" class="form-control" rows="3" placeholder="限300字内"><?php echo empty($memorial['brief']) ? '':$memorial['brief']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">生日：</label>
                            <div class="col-sm-8">
                                <input id="birthday" name="birthday" value="<?php echo empty($memorial['birthday']) ? '':$memorial['birthday']; ?>" class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">忌日：</label>
                            <div class="col-sm-8">
                                <input id="death" name="death" value="<?php echo empty($memorial['death']) ? '':$memorial['death']; ?>" class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">墓志铭：</label>
                            <div class="col-sm-8">
                                <textarea id="epitaph" name="epitaph" class="form-control" rows="3" placeholder="限100字内"><?php echo empty($memorial['epitaph']) ? '':$memorial['epitaph']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">纪事：</label>
                            <div class="col-sm-8">
                                <textarea name="content" id="editor" placeholder="输入人物纪事。内容建议：父母子女，个性天赋，人品志向，生平要事。限500字。可在电脑端登陆编辑。"><?php echo empty($memorial['content']) ? '':$memorial['content']?></textarea>
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
        $('#add').validate({
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
            }
        });

    });
</script>

<!-- layerDate plugin javascript -->
<script src="<?php echo base_url() ?>/assets/home/js/plugins/layer/laydate/laydate.js"></script>

<!-- simditor -->
<script type="text/javascript" src="<?php echo base_url() ?>/assets/home/js/plugins/simditor/module.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/home/js/plugins/simditor/uploader.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/home/js/plugins/simditor/hotkeys.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/home/js/plugins/simditor/simditor.js"></script>
<script>
    $(document).ready(function () {
        var editor = new Simditor({
            textarea: $('#editor'),
            defaultImage: '<?php echo base_url() ?>/assets/home/img/a9.jpg',
            placeholder : '这里输入内容...',
            pasteImage: true,
            toolbarFloat:true,
            toolbar : toolbar,  //工具栏
            upload : {
                url : '<?php echo site_url('memorial/upload_img')?>', //文件上传的接口地址
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
