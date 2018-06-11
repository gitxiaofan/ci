<?php
//var_dump($data);
$memorial = $data['memorial'];
$images = $data['images'];
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $memorial['name']. '_'. $settings['sitename']?></title>
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
<div class="menu">
    <div class="gohome"><a class="animated bounceInUp" href="" title="返回首页"><i class="fa fa-bars"></i></a></div>
</div>
<div id="slider" class="carousel slide" data-ride="carousel" data-interval="3000">
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <?php foreach($images as $k => $slider): ?>
            <div class="item <?php echo $k == 0 ? 'active':'' ?>">
                <img src="<?php echo base_url().$slider['pic']?>" alt="<?php echo $slider['name']?>">
            </div>
        <?php endforeach; ?>
    </div>
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <?php for($i=0;$i<=$k;$i++):?>
            <li data-target="#slider" data-slide-to="<?php echo $i;?>" class="<?php echo $i==0 ? 'active':''?>"></li>
        <?php endfor; ?>
    </ol>
</div>

<div class="content">
    <div class="container">
        <div class="title">
            <?php echo htmlspecialchars_decode($memorial['name']); ?>
        </div>
        <div class="time">
            <?php echo $memorial['birthday']. ' - '. $memorial['death']?>
        </div>
        <div class="info">
            <?php echo htmlspecialchars_decode($memorial['content']); ?>
        </div>
    </div>
</div>

<div class="detail-menu">
    <div class="container">
        <div class="row">
            <nav class="bar">
                <a class="bar-item" href="<?php echo site_url('memorial/detail'). '?id='. $memorial['id']?>">
                    <span class="bar-icon"><i class="fa fa-university"></i></span>
                    <span class="bar-label">主页</span>
                </a>
                <a class="bar-item active" href="<?php echo site_url('memorial/content'). '?id='. $memorial['id']?>">
                    <span class="bar-icon"><i class="fa fa-user"></i></span>
                    <span class="bar-label">纪事</span>
                </a>
                <a class="bar-item" href="<?php echo site_url('memorial/sacrifice'). '?id='. $memorial['id']?>">
                    <span class="bar-icon"><i class="fa fa-tachometer"></i></span>
                    <span class="bar-label">礼祭</span>
                </a>
                <a class="bar-item" href="#">
                    <span class="bar-icon"><i class="fa fa-commenting"></i></span>
                    <span class="bar-label">追思</span>
                </a>
            </nav>
        </div>
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
