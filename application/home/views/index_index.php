<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $settings['sitename']. '_'. $settings['sitesubtitle']?></title>
    <meta name="keywords" content="<?php echo $settings['sitekeyword']?>">
    <meta name="description" content="<?php echo $settings['sitedescription']?>">
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/home/favicon.ico">
    <link href="<?php echo base_url() ?>/assets/home/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/dropload.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/home/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/style.css" rel="stylesheet">

    <!--远程字体库-->
    <script type="text/javascript" src="http://cdn.webfont.youziku.com/wwwroot/js/wf/youziku.api.min.js"></script>
    <script type="text/javascript">
        $youziku.load("body", "6c0c14d3d2da4029bee76c045e977fca", "hdjlibian");
        $youziku.draw();
    </script>
</head>

<body class="main-bg">
<?php
//print_r($data);
//print_r($_SESSION['user']);
?>
<?php include_once('menu.php');?>
<div class="index-top">
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
                                <input type="submit" class="btn btn-primary" value="搜索">
                            </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="home-list content">
    <div class="container">
        <div class="row">
            <?php if($data['memorials']): ?>
            <?php if(empty($_GET['k'])):?>
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
                <?php foreach($data['memorials'] as $memorail): ?>
                <div class="col-xs-12">
                    <div class="item item-k">
                        <a href="<?php echo site_url('memorial/detail').'?id='. $memorail['id']; ?>">
                            <span class="name <?php echo $memorail['is_strong'] == 1 ? 'strong':''?>"><?php echo $memorail['name']?></span>
                            <span class="time">(<?php echo $memorail['birthday']. '-'. $memorail['death']?>)</span>
                        </a>
                    </div>
                </div>
                    <?php endforeach; ?>
            <?php endif; ?>
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

<!--ajax分页-->
<script src="<?php echo base_url() ?>/assets/home/js/dropload.min.js"></script>
<script>
    $(function(){
        // 页数
        var page = 1;
        // 每页展示5个
        var size = 40;

        // dropload
        $('.content').dropload({
            scrollArea : window,
            loadDownFn : function(me){
                page++;
                // 拼接HTML
                var result = '';
                $.ajax({
                    type: 'GET',
                    url: '<?php echo site_url('index/index')?>?page='+page+'&size='+size+'&k=<?php echo empty($_GET['k']) ? '':$_GET['k']; ?>',
                    dataType: 'json',
                    success: function(data){
                        //console.log(data);
                        var arrLen = data.length;
                        if(arrLen > 0){
                            for(var i=0; i<arrLen; i++){
                                var c = '';
                                if(data[i].is_strong == 1){
                                    c = 'strong';
                                }
                                result += '<div class="col-xs-3">'
                                    +'<div class="item">'
                                    +'<a href="<?php echo site_url('memorial/detail').'?id='; ?>' + data[i].id + '">'
                                    +'<span class="name ' + c + '">' + data[i].name + '</span>'
                                    +'</a>'
                                    +'</div>'
                                    +'</div>';
                            }
                            // 如果没有数据
                        }else{
                            // 锁定
                            me.lock();
                            // 无数据
                            me.noData();
                        }
                        // 插入数据到页面，放到最后面
                        $('.content .container .row').append(result);
                        // 每次数据插入，必须重置
                        me.resetload();
                    },
                    error: function(xhr, type){
                        alert('Ajax error!');
                        // 即使加载出错，也得重置
                        me.resetload();
                    }
                });
            }
        });
    });
</script>

</body>

</html>
