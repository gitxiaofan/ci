<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>纪念馆 - 追思网</title>

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
                    <h5>纪念馆</h5>
                    <div class="ibox-tools">
                        <a href="<?php echo site_url('memorial/index')?>">
                            <i class="fa fa-refresh"></i> 刷新列表
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-9">
                            <a href="<?php echo site_url('memorial/add'); ?>" class="btn btn-primary ">添加纪念馆</a>
                        </div>
                        <div class="col-sm-3">
                            <form action="<?php echo site_url('memorial/index')?>">
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
                            <th>姓名</th>
                            <th>照片</th>
                            <th>创建人</th>
                            <th>突出显示</th>
                            <th>置顶</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($memorials as $memorial): ?>
                            <tr>
                                <td><?php echo $memorial['id']; ?></td>
                                <td><?php echo $memorial['name']; ?></td>
                                <td class="memorial_image">
                                    <?php if(!empty($memorial['images'])):?>
                                        <?php foreach($memorial['images'] as $image):?>
                                        <div class="item">
                                            <img width="100%" src="<?php echo base_url().'/'.$image['pic']; ?>" >
                                            <a href="<?php echo site_url('memorial/avater_delete'). '?image_id='. $image['id']; ?>"><i class="fa fa-times"></i> 删除</a>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif;?>
                                    <div class="add">
                                        <a class="btn btn-xs btn-info" href="<?php echo site_url('memorial/avater'). '?id='. $memorial['id']; ?>">添加照片</a>
                                    </div>
                                </td>
                                <td><?php echo $memorial['author'] ? $memorial['author'].' ['.$memorial['user_id'].']':'无'; ?></td>
                                <td><?php echo $memorial['is_strong'] == 1 ? '是':'否' ?></td>
                                <td><?php echo $memorial['stick'] == 1 ? '是':'否' ?></td>
                                <td><?php echo $memorial['ctime']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo site_url('memorial/mod'). '?id='. $memorial['id']; ?>" class="btn btn-info btn-sm">修改</a>
                                        <a href="<?php echo site_url('memorial/del'). '?id='. $memorial['id']; ?>" class="btn btn-danger btn-sm">删除</a>
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

<!-- 自定义js -->
<script src="<?php echo base_url() ?>/assets/admin/js/content.js?v=1.0.0"></script>

</body>

</html>
