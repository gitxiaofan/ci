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
                                <button data-id="<?php echo $memorial['id']?>" class="btn btn-sm btn-follow">已关注</button>
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
<script>
    $('.btn-follow').click(function(){
        var _this= $(this);
        var data = {id: $(this).data('id'), status: 0};
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('memorial/follow')?>',
            data: data,
            dataType: 'json',
            success: function(data){
                if(data.status == 1){
                    _this.parentsUntil('li').remove();
                }else if(data.status == -2){
                    window.location.href='<?php echo site_url('login/index')?>';
                }
            }
        });
    });
</script>

</body>

</html>
