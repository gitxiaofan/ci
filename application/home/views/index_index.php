<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $settings['sitename']. '_'. $settings['sitesubtitle']?></title>
    <meta name="keywords" content="<?php echo $settings['sitekeyword']?>">
    <meta name="description" content="<?php echo $settings['sitedescription']?>">

    <link href="<?php echo base_url() ?>/assets/home/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/home/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/style.css" rel="stylesheet">


</head>

<body class="main-bg">
<?php
//print_r($data);
?>
<div class="menu">
    <div class="gohome"><a class="animated bounceInUp" href="" title="返回首页"><i class="fa fa-bars"></i></a></div>
</div>
<div id="slider" class="carousel slide" data-ride="carousel" data-interval="3000">
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <?php foreach($data['sliders'] as $k => $slider): ?>
        <div class="item <?php echo $k == 0 ? 'active':'' ?>">
            <a href="<?php echo $slider['link']?>"><img src="<?php echo $slider['pic']?>" alt="<?php echo $slider['title']?>"></a>
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
<div class="home-search">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="search-form">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" name="k" class="form-control" placeholder="请输入纪念人姓名" value="<?php echo empty($_GET['k']) ? '':$_GET['k']; ?>">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary">搜索</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="home-list">
    <div class="container">
        <div class="row">
            <?php if($data['memorials']): ?>
            <?php foreach($data['memorials'] as $memorail): ?>
            <div class="col-xs-3">
                <div class="item">
                    <a href="<?php echo site_url('memorial/detail').'?id='. $memorail['id']; ?>">
                        <span class="name <?php echo $memorail['is_strong'] == 1 ? 'strong':''?>"><?php echo $memorail['name']?></span>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-xs-12">
                <div class="item">
                    <span class="name">没有Ta的纪念馆？请注册，然后为Ta<a class="strong" href="#" >创建</a>。</span>
                </div>
            </div>
            <?php endif; ?>
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
