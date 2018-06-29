<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>广告 - 追思网</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="<?php echo base_url() ?>/assets/admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/admin/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<?php
//print_r($adcats);
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>广告</h5>
                    <div class="ibox-tools">
                        <a href="<?php echo site_url('ad/index')?>">
                            <i class="fa fa-refresh"></i> 刷新列表
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-9">
                            <a href="<?php echo site_url('ad/add'); ?>" class="btn btn-primary ">添加广告</a>
                        </div>
                        <div class="col-sm-3">
                            <form action="<?php echo site_url('ad/index')?>">
                                <div class="input-group">
                                    <input type="text" name="k" value="<?php echo empty($_GET['k']) ? '':$_GET['k']?>" placeholder="请输入关键词" class="input-sm form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>广告名称</th>
                            <th>图片</th>
                            <th>分类</th>
                            <th>排序</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($ads as $ad): ?>
                            <tr>
                                <td><?php echo $ad['id']; ?></td>
                                <td><?php echo $ad['title']; ?></td>
                                <td><img height="50" src="<?php echo $ad['pic'] ?>"></td>
                                <td><?php echo $adcats[$ad['cat_id']]; ?></td>
                                <td><?php echo $ad['sort']; ?></td>
                                <td><?php echo $ad['ctime']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo site_url('ad/mod'). '?id='. $ad['id']; ?>" class="btn btn-info btn-sm">修改</a>
                                        <a href="<?php echo site_url('ad/del'). '?id='. $ad['id']; ?>" class="btn btn-danger btn-sm">删除</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-sm-12">
                        <nav class="pull-right">
                            <ul class="pagination">
                                <?php echo $pagination; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 全局js -->
<script src="<?php echo base_url() ?>/assets/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo base_url() ?>/assets/admin/js/bootstrap.min.js?v=3.3.6"></script>



<script src="<?php echo base_url() ?>/assets/admin/js/plugins/jeditable/jquery.jeditable.js"></script>

<!-- Data Tables -->
<script src="<?php echo base_url() ?>/assets/admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>/assets/admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- 自定义js -->
<script src="<?php echo base_url() ?>/assets/admin/js/content.js?v=1.0.0"></script>


<!-- Page-Level Scripts -->
<script>
    $(document).ready(function () {

        /* Init DataTables */
        var oTable = $('#editable').dataTable();


    });

</script>


</body>

</html>
