<?php
$memorials= $data['memorials'];
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>管理纪念馆_<?php echo $settings['sitename']?></title>
    <meta name="keywords" content="<?php echo $settings['sitekeyword']?>">
    <meta name="description" content="<?php echo $settings['sitedescription']?>">

    <link href="<?php echo base_url() ?>/assets/home/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/home/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/style.css" rel="stylesheet">


</head>

<body class="detail-bg">
<?php
//print_r($data);
?>
<?php include_once('menu.php');?>
<div class="manage">
    <div class="container">
        <div class="manage-title">
            <h3>我创建的纪念馆</h3>
        </div>
        <ul class="manage-list list-unstyled">
            <?php foreach($memorials as $memorial): ?>
            <li>
                <div class="row">
                    <div class="col-xs-6">
                        <a href="<?php echo site_url('memorial/detail'). '?id='. $memorial['id']?>">
                            <img class="img-responsive img-rounded" src="<?php echo empty($memorial['images'][0]['pic']) ? base_url().'assets/home/img/avater_demo.png' :  base_url().$memorial['images'][0]['pic']?>">
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <div class="title">
                            <a href="<?php echo site_url('memorial/detail'). '?id='. $memorial['id']?>">
                                <?php echo $memorial['name']?>
                            </a>
                        </div>
                        <div class="operation">
                            <a href="<?php echo site_url('memorial/mod'). '?id='. $memorial['id']?>" class="btn btn-sm btn-primary">编辑</a>
                            <a href="<?php echo site_url('memorial/delete'). '?id='. $memorial['id']?>" class="btn btn-sm btn-danger">删除</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- 全局js -->
<script src="<?php echo base_url() ?>/assets/home/js/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo base_url() ?>/assets/home/js/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo base_url() ?>/assets/home/js/plugins/layer/layer.min.js"></script>

<!-- 自定义js -->
<script src="<?php echo base_url() ?>/assets/home/js/content.js"></script>

</body>

</html>
