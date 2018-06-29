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
    <link href="<?php echo base_url() ?>/assets/home/css/dropload.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/home/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/home/css/style.css" rel="stylesheet">

</head>

<body class="detail-bg">
<?php
//print_r($data);
?>
<?php include_once('menu.php');?>
<div class="manage manage-list">
    <div class="container">
        <div class="manage-title">
            <h3>我创建的纪念馆</h3>
        </div>
        <ul class=" list-unstyled">
            <?php foreach($memorials as $memorial): ?>
            <li>
                <div class="row">
                    <div class="col-xs-6">
                        <a href="<?php echo site_url('memorial/detail'). '?id='. $memorial['id']?>">
                            <img class="img-responsive img-rounded" src="<?php echo empty($memorial['image']) ? base_url().'assets/home/img/avater_demo.png' :  base_url().$memorial['image']?>">
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

<!--ajax分页-->
<script src="<?php echo base_url() ?>/assets/home/js/dropload.min.js"></script>
<script>
    $(function(){
        // 页数
        var page = 1;
        // 每页展示20个
        var size = 6;

        // dropload
        $('.manage-list').dropload({
            scrollArea : window,
            loadDownFn : function(me){
                page++;
                // 拼接HTML
                var result = '';
                $.ajax({
                    type: 'GET',
                    url: '<?php echo site_url('memorial/manage'). '?id='. $memorial['id']?>&page='+page+'&size='+size,
                    dataType: 'json',
                    success: function(data){
                        //console.log(data);
                        var arrLen = data.length;
                        if(arrLen > 0){
                            for(var i=0; i<arrLen; i++){
                                var image = '<?php echo base_url() ?>assets/home/img/avater_demo.png';
                                if(data[i].images){
                                    image = '<?php echo base_url()?>'+data[i].image;
                                }
                                result += '<li>\n'+
                                    '<div class="row">\n'+
                                    '<div class="col-xs-6">\n'+
                                    '<a href="<?php echo site_url("memorial/detail"). "?id="?>'+ data[i].id+'">\n'+
                                    '<img class="img-responsive img-rounded" src="'+image+'">\n'+
                                    '</a>\n'+
                                    '</div>\n'+
                                    '<div class="col-xs-6">\n'+
                                    '<div class="title">\n'+
                                    '<a href="<?php echo site_url("memorial/detail"). "?id="?>'+ data[i].id+'">\n'+
                                    data[i].name+
                                    '</a>\n'+
                                    '</div>\n'+
                                    '<div class="operation">\n'+
                                    '<a href="<?php echo site_url("memorial/mod"). "?id="?>" class="btn btn-sm btn-primary">编辑</a>\n'+
                                    '<a href="<?php echo site_url("memorial/delete"). "?id="?>'+ data[i].id+'" class="btn btn-sm btn-danger">删除</a>\n'+
                                    '</div>\n'+
                                    '</div>\n'+
                                    '</div>\n'+
                                    '</li>';
                            }
                            // 如果没有数据
                        }else{
                            // 锁定
                            me.lock();
                            // 无数据
                            me.noData();
                        }
                        // 插入数据到页面，放到最后面
                        $('.manage-list .container ul').append(result);
                        // 每次数据插入，必须重置
                        me.resetload();
                    },
                    error: function(xhr, type){
                        //alert('Ajax error!');
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
