<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 高级表单</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

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
                        <h5>图片裁剪 <small>http://fengyuanchen.github.io/cropper/</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">选项 01</a>
                                </li>
                                <li><a href="#">选项 02</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <p>
                            一款简单的jQuery图片裁剪插件
                        </p>
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
                                    你可以选择新图片上传，然后下载裁剪后的图片
                                </p>
                                <div class="btn-group">
                                    <label title="上传图片" for="inputImage" class="btn btn-primary">
                                        <input type="file" accept="image/*" name="file" id="inputImage" class="hide"> 上传新图片
                                    </label>
                                    <label title="下载图片" id="download" class="btn btn-primary">下载</label>
                                </div>
                                <h4>其他说明：</h4>
                                <p>
                                    你可以使用<code>$({image}).cropper(options)</code>来配置插件
                                </p>
                                <div class="btn-group">
                                    <button class="btn btn-white" id="zoomIn" type="button">放大</button>
                                    <button class="btn btn-white" id="zoomOut" type="button">缩小</button>
                                    <button class="btn btn-white" id="rotateLeft" type="button">左旋转</button>
                                    <button class="btn btn-white" id="rotateRight" type="button">右旋转</button>
                                    <button class="btn btn-warning" id="setDrag" type="button">裁剪</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">颜色选择</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group colorpicker-component demo demo-auto">
                        <input type="text" value="" class="form-control" />
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

    <script src="<?php echo base_url() ?>/assets/admin/js/demo/form-advanced-demo.js"></script>



</body>

</html>
