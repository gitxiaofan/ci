<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>广告分类 - 追思网</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="<?php echo base_url() ?>/assets/admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/admin/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>广告分类</h5>
                    <div class="ibox-tools">
                        <a href="<?php echo site_url('ad/cat')?>">
                            <i class="fa fa-refresh"></i> 刷新列表
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="">
                        <a href="<?php echo site_url('ad/addcat'); ?>" class="btn btn-primary ">添加广告</a>
                    </div>
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>分类名称</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($adcats as $adcat): ?>
                            <tr>
                                <td><?php echo $adcat['id']; ?></td>
                                <td><?php echo $adcat['name']; ?></td>
                                <td><?php echo $adcat['ctime']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo site_url('ad/modcat'). '?id='. $adcat['id']; ?>" class="btn btn-info btn-sm">修改</a>
                                        <a href="<?php echo site_url('ad/delcat'). '?id='. $adcat['id']; ?>" class="btn btn-danger btn-sm">删除</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

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


</body>

</html>
