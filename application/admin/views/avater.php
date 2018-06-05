<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>修改头像 - 追思网</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/admin/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/admin/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title  back-change">
                        <h5>修改头像</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="image-crop">
                                    <img src="<?php echo base_url() ?>/assets/admin/img/a3.jpg">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>图片预览：</h4>
                                <div class="img-preview img-preview-sm"></div>
                                <h4>说明：</h4>
                                <p>
                                    你可以选择本地图片，然后完成裁剪后上传即可。
                                </p>
                                <div class="btn-group">
                                    <label title="上传图片" for="inputImage" class="btn btn-info">
                                        <input type="file" accept="image/*" name="file" id="inputImage" class="hide"> 选择本地图片
                                    </label>
                                </div>
                                <p></p>
                                <div class="btn-group">
                                    <button class="btn btn-white" id="zoomIn" type="button">放大</button>
                                    <button class="btn btn-white" id="zoomOut" type="button">缩小</button>
                                    <button class="btn btn-white" id="rotateLeft" type="button">左旋转</button>
                                    <button class="btn btn-white" id="rotateRight" type="button">右旋转</button>
                                    <button class="btn btn-primary" id="download" type="button">完成上传</button>
                                </div>
                            </div>
                        </div>
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

    <!-- Image cropper -->
    <script src="<?php echo base_url() ?>/assets/admin/js/plugins/cropper/cropper.min.js"></script>

    <script>
        $(document).ready(function () {

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: <?php echo empty($ratio) ? 1:$ratio; ?>,
                preview: ".img-preview",
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
                $.post('<?php echo site_url($module.'/avater'); ?>',{img:img64,id:<?php echo $id; ?>},function(res){
                    var obj = JSON.parse(res);
                    if(obj.status == 1){
                        window.location.href="<?php echo site_url($module.'/index')?>";
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



</body>

</html>
