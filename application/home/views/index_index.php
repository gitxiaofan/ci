<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $settings['sitename']. '_'. $settings['sitesubtitle']?></title>
    <meta name="keywords" content="<?php echo $settings['sitekeyword']?>">
    <meta name="description" content="<?php echo $settings['sitedescription']?>">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/home/css/light7.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/home/css/light7-swiper.min.css">

    <!--<link rel="stylesheet" href="<?php echo base_url() ?>/assets/home/css/style.css">-->
</head>
<body>
<?php
print_r($data);
?>
<div class="page">
    <header class="bar bar-nav">
        <a class="button button-link button-nav pull-left" href="/demos/card" data-transition='slide-out'>
            <span class="icon icon-left"></span>
            返回
        </a>
        <h1 class="title">我的生活</h1>
    </header>
    <nav class="bar bar-tab">
        <a class="tab-item active" href="#">
            <span class="icon icon-home"></span>
            <span class="tab-label">首页</span>
        </a>
        <a class="tab-item" href="#">
            <span class="icon icon-me"></span>
            <span class="tab-label">我</span>
        </a>
        <a class="tab-item" href="#">
            <span class="icon icon-star"></span>
            <span class="tab-label">收藏</span>
        </a>
        <a class="tab-item" href="#">
            <span class="icon icon-settings"></span>
            <span class="tab-label">设置</span>
        </a>
    </nav>
    <div class="content">
        <!-- 这里是页面内容区 -->
    </div>
</div>


<script type='text/javascript' src='<?php echo base_url() ?>/assets/home/js/jquery.min.js' charset='utf-8'></script>
<script type='text/javascript' src='<?php echo base_url() ?>/assets/home/js/light7.min.js' charset='utf-8'></script>
<script type='text/javascript' src='<?php echo base_url() ?>/assets/home/js/light7-swiper.min.js' charset='utf-8'></script>

<!--<script src="<?php echo base_url() ?>/assets/home/custom.js"></script>-->
</body>
</html>