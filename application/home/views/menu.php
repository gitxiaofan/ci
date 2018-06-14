<!--手机导航栏-->
<div id="mobile-menu" class="mobile-nav hide-nav">
    <?php if(empty($_SESSION['user'])):?>
        <ul class="list-unstyled">
            <li class="login"><a href="<?php echo site_url('login/index')?>">登录</a> | <a href="<?php echo site_url('login/reg')?>">注册</a></li>
            <li><a href="<?php echo site_url('index/index')?>">首页</a></li>
            <li><a href="#">关于</a></li>
        </ul>
    <?php else: ?>
        <ul class="list-unstyled">
            <li><a href="">您好，<?php echo $_SESSION['user']['nickname']?></a></li>
            <li><a href="<?php echo site_url('memorial/add')?>">创建</a> </li>
            <li><a href="<?php echo site_url('memorial/manage')?>">管理</a> </li>
            <li><a href="<?php echo site_url('memorial/myfollow')?>">我的关注</a> </li>
            <li><a href="">修改账户</a> </li>
            <li><a href="<?php echo site_url('login/logout')?>">退出</a></li>
            <li><a href="<?php echo site_url('index/index')?>">首页</a></li>
            <li><a href="#">关于</a></li>
        </ul>
    <?php endif;?>
</div>
<!--手机导航栏侧滑-->
<div class="nav-btn visible-xs visible-sm">
    <a href="javascript:void(0)" class="animated bounceInUp mobile-nav-taggle" id="mobile-nav-taggle">
        <span class="glyphicon glyphicon-align-justify"></span>
    </a>
</div>