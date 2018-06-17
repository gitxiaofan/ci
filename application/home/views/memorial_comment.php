<?php
//var_dump($data);
$memorial = $data['memorial'];
$images = $data['images'];
$comments = $data['comments'];
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

<body class="detail-bg">
<?php
//print_r($data);
?>
<?php include_once('menu.php');?>
<?php if($images):?>
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
<?php endif;?>
<div class="follow">
    <?php if(!empty($data['follow_status']) && $data['follow_status'] == 1):?>
        <button id="follow" class="btn btn-sm btn-follow">已关注</button>
    <?php else: ?>
        <button id="follow" class="btn btn-sm btn-primary">关注</button>
    <?php endif; ?>
</div>
<div class="comment">
    <div class="memorial-name container">
        <div class="title">
            <?php echo htmlspecialchars_decode($memorial['name']); ?>
        </div>
        <div class="time">
            <?php echo $memorial['birthday']. ' - '. $memorial['death']?>
        </div>
    </div>
    <div class="container">
        <form action="" method="post">
            <textarea name="content" class="form-control" rows="4" placeholder="追思留言，300字以内"></textarea>
            <div class="submit">
                <input type="hidden" name="id" value="<?php echo $memorial['id']?>">
                <input type="submit" class="btn btn-primary" value="发布">
            </div>
        </form>
    </div>
    <div class="comment-list">
        <div class="container">
            <ul class="list-unstyled">
                <?php foreach ($comments as $comment):?>
                    <li data-id="<?php echo $comment['id']?>">
                        <div class="title">
                            <span class="time"><?php echo $comment['ctime'];?></span>
                            <span class="author"><?php echo $comment['nickname'] ?>:</span>
                        </div>
                        <div class="comment-content">
                            <?php echo $comment['content']?>
                        </div>
                        <?php if(!empty($_SESSION['user']['user_id']) && $memorial['user_id'] == $_SESSION['user']['user_id']):?>
                        <div class="operation">
                            <button class="btn btn-xs btn-primary comment-del"><i class="fa fa-times"></i> 删除</button>
                        </div>
                        <?php endif;?>
                    </li>
                <?php endforeach;?>
            </ul>
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
                <a class="bar-item" href="<?php echo site_url('memorial/content'). '?id='. $memorial['id']?>">
                    <span class="bar-icon"><i class="fa fa-user"></i></span>
                    <span class="bar-label">纪事</span>
                </a>
                <a class="bar-item" href="<?php echo site_url('memorial/sacrifice'). '?id='. $memorial['id']?>">
                    <span class="bar-icon"><i class="fa fa-gift"></i></span>
                    <span class="bar-label">礼祭</span>
                </a>
                <a class="bar-item active" href="<?php echo site_url('memorial/comment'). '?id='. $memorial['id']?>">
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
<script>
    $('#follow').click(function(){
        var _this= $(this);
        var status;
        if($(this).text() == '关注'){
            status = 1;
        }else{
            status = 0;
        }
        var mess = new Array('关注','已关注');
        var myclass1 = new Array('btn-follow','btn-primary');
        var myclass2 = new Array('btn-primary','btn-follow');
        var data = {id: <?php echo $memorial['id']?>, status: status};
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('memorial/follow')?>',
            data: data,
            dataType: 'json',
            success: function(data){
                if(data.status == 1){
                    _this.text(mess[status]);
                    _this.removeClass(myclass1[status]);
                    _this.addClass(myclass2[status]);
                }else if(data.status == -2){
                    window.location.href='<?php echo site_url('login/index')?>';
                }
            }
        });
    });
</script>

<!--删除评论-->
<script>
    $('body').on('click','.comment-del',function(){
        var _this = $(this).parent().parent();
        var id = _this.data('id');
        //console.log(id);
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('memorial/delcomment')?>?id='+id,
            dataType: 'text',
            success: function(data){
                //console.log(data);
                if(data == 'true'){
                    _this.remove();
                }else{
                    alert('删除失败');
                }
            }
        });
    });
</script>

<!--ajax分页-->
<script src="<?php echo base_url() ?>/assets/home/js/dropload.min.js"></script>
<script>
    $(function(){
        // 页数
        var page = 1;
        // 每页展示20个
        var size = 20;

        // dropload
        $('.comment-list').dropload({
            scrollArea : window,
            loadDownFn : function(me){
                page++;
                // 拼接HTML
                var result = '';
                $.ajax({
                    type: 'GET',
                    url: '<?php echo site_url('memorial/comment'). '?id='. $memorial['id']?>&page='+page+'&size='+size,
                    dataType: 'json',
                    success: function(data){
                        //console.log(data);
                        var arrLen = data.length;
                        if(arrLen > 0){
                            var operation;
                            operation = '<?php echo  !empty($_SESSION['user']['user_id']) && $memorial['user_id'] == $_SESSION['user']['user_id'] ? 1:0?>';
                            if(operation == 1){
                                for(var i=0; i<arrLen; i++){
                                    result += '<li data-id="'+data[i].id+'">\n' +
                                        '<div class="title">\n' +
                                        '<span class="time">'+data[i].ctime+'</span>\n'+
                                        '<span class="author">'+data[i].nickname+':</span>\n' +
                                        '</div>\n' +
                                        '<div class="comment-content">\n' +
                                        data[i].content+'\n' +
                                        '</div>\n' +
                                        '<div class="operation">\n'+
                                        '<button class="btn btn-xs btn-primary comment-del"><i class="fa fa-times"></i> 删除</button>\n'+
                                        '</div>\n'+
                                        '</li>';
                                }
                            }else{
                                for(var i=0; i<arrLen; i++){
                                    result += '<li data-id="'+data[i].id+'">\n' +
                                        '<div class="title">\n' +
                                        '<span class="time">'+data[i].ctime+'</span>\n'+
                                        '<span class="author">'+data[i].nickname+':</span>\n' +
                                        '</div>\n' +
                                        '<div class="comment-content">\n' +
                                        data[i].content+'\n' +
                                        '</div>\n' +
                                        '</li>';
                                }
                            }
                            // 如果没有数据
                        }else{
                            // 锁定
                            me.lock();
                            // 无数据
                            me.noData();
                        }
                        // 插入数据到页面，放到最后面
                        $('.comment-list .container ul').append(result);
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
