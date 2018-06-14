<?php
//print_r($data);
$memorial = $data['memorial'];
$images = $data['images'];
?>
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
    <link href="<?php echo base_url() ?>/assets/home/css/plugins/cropper/cropper.min.css" rel="stylesheet">
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
                            <label class="col-sm-3 control-label">照片（1-3张）：</label>
                            <div class="col-sm-8">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#picModal">
                                    <i class="fa fa-plus"></i> 添加图片
                                </button>
                                <div class="memorial-pic" id="memorial-pic">
                                    <?php if(!empty($images)):?>
                                    <?php foreach ($images as $image):?>
                                            <div class="col-xs-4 item">
                                                <img src="<?php echo base_url(). $image['pic']?>">
                                                <input type="hidden" name="pic[]" value="<?php echo $image['pic']?>">
                                                <a href="javascript:void(0)" class="deletepic"><i class="fa fa-times"></i> 删除</a>
                                            </div>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </div>
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

<div class="modal inmodal" id="picModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                </button>
                <div class="btn-group">
                    <label title="上传图片" for="inputImage" class="btn btn-info">
                        <input type="file" accept="image/*" name="file" id="inputImage" class="hide"> 选择本地图片
                    </label>
                </div>
            </div>
            <div class="modal-body">
                <div class="image-crop">
                    <img src="<?php echo base_url() ?>/assets/home/img/avater.jpg">
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <button class="btn btn-white" id="zoomIn" type="button">放大</button>
                    <button class="btn btn-white" id="zoomOut" type="button">缩小</button>
                    <button class="btn btn-white" id="rotateLeft" type="button">左旋转</button>
                    <button class="btn btn-white" id="rotateRight" type="button">右旋转</button>
                    <button class="btn btn-primary" id="download" type="button">裁剪上传</button>
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
                },
                birthday: {
                    required: true
                },
                death: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: icon + "请输入您的姓名/昵称",
                    minlength: icon + "姓名/昵称必须两个字符以上"
                },
                birthday: {
                    required: icon + "请输入生日"
                },
                death: {
                    required: icon + "请输入忌日"
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

<!-- Image cropper -->
<script src="<?php echo base_url() ?>/assets/home/js/plugins/cropper/cropper.min.js"></script>

<script>
    $(document).ready(function () {

        var $image = $(".image-crop > img")
        $($image).cropper({
            aspectRatio: 1.618,
            //preview: ".img-preview",
            done: function (data) {
                // 输出结果
            }
        });

        var $inputImage = $("#inputImage");
        if (window.FileReader) {
            $inputImage.change(function () {
                var fileReader = new FileReader(),
                    files = this.files,
                    file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("请选择图片文件");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#download").click(function () {
            var img64 = $image.cropper("getDataURL");
            $.post('<?php echo site_url('memorial/avater'); ?>',{img:img64},function(res){
                console.log(res);
                var obj = JSON.parse(res);
                if(obj.status == 1){
                    $('.close').click();
                    var pichtml = '<div class="col-xs-4 item">\n' +
                        '<img src="<?php echo base_url()?>' + obj.pic + '">\n' +
                        '<input type="hidden" name="pic[]" value="' + obj.pic + '">\n' +
                        '<a href="javascript:void(0)" class="deletepic"><i class="fa fa-times"></i> 删除</a>\n' +
                        '</div>';
                    $('#memorial-pic').append(pichtml);
                }else{
                    alert(obj.message);
                }
            });
        });

        $("#zoomIn").click(function () {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function () {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function () {
            $image.cropper("rotate", 90);
        });

        $("#rotateRight").click(function () {
            $image.cropper("rotate", -90);
        });

        $("#setDrag").click(function () {
            $image.cropper("setDragMode", "crop");
        });

    });
</script>

<script>
    $('body').on('click','.deletepic',function(){
        $(this).parent().remove();
    });
</script>

</body>

</html>
