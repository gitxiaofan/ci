<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>管理员 - 追思网</title>
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
                        <h5>管理员</h5>
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
                            <div class="col-sm-9">
                                <a href="<?php echo site_url('admin/add'); ?>" class="btn btn-primary ">添加管理员</a>
                            </div>
                            <div class="col-sm-3">
                                <form action="<?php echo site_url('admin/index')?>">
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
                                <th>用户名</th>
                                <th>头像</th>
                                <th>角色</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($admins as $admin): ?>
                                <tr>
                                    <td><?php echo $admin['admin_id']; ?></td>
                                    <td><?php echo $admin['username']; ?></td>
                                    <td>
                                        <?php if($admin['avater']):?>
                                            <img width="50" src="<?php echo base_url().'/'.$admin['avater']; ?>" >
                                            <a class="btn btn-xs btn-info" href="<?php echo site_url('admin/avater'). '?id='. $admin['admin_id']; ?>">修改头像</a>
                                        <?php else: ?>
                                            <a class="btn btn-xs btn-info" href="<?php echo site_url('admin/avater'). '?id='. $admin['admin_id']; ?>">添加头像</a>
                                        <?php endif;?>
                                    </td>
                                    <td>管理员</td>
                                    <td><?php echo $admin['ctime']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo site_url('admin/mod'). '?id='. $admin['admin_id']; ?>" class="btn btn-info btn-sm">修改</a>
                                            <a href="<?php echo site_url('admin/del'). '?id='. $admin['admin_id']; ?>" class="btn btn-danger btn-sm">删除</a>
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
    </div>

    <!-- 全局js -->
    <script src="<?php echo base_url() ?>/assets/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="<?php echo base_url() ?>/assets/admin/js/bootstrap.min.js?v=3.3.6"></script>

    <!-- 自定义js -->
    <script src="<?php echo base_url() ?>/assets/admin/js/content.js?v=1.0.0"></script>


</body>

</html>
