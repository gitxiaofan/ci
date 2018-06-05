<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>管理后台 - 追思网</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url() ?>/assets/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/admin/css/style.css?v=4.1.0" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<?php
//print_r($_SESSION['admin']);
?>
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img width="70" alt="image" class="img-circle" src="<?php echo empty($_SESSION['admin']['avater']) ? base_url().'/assets/admin/img/profile_small.jpg' : base_url().'/'.$_SESSION['admin']['avater']; ?>" /></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?php echo $_SESSION['admin']['username']; ?></strong></span>
                                <span class="text-muted text-xs block">管理员<b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="<?php echo site_url('admin/avater'). '?id='. $_SESSION['admin']['admin_id']; ?>">修改头像</a>
                                </li>
                                <li><a class="J_menuItem" href="<?php echo site_url('admin/mod'). '?id='. $_SESSION['admin']['admin_id']; ?>">个人资料</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('login/logout')?>">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">H+
                        </div>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo site_url('home/show')?>"><i class="fa fa-home"></i><span class="nav-label">仪表盘</span></a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <span class="nav-label">管理员</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo site_url('admin/index'); ?>">所有管理员</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo site_url('admin/add'); ?>">添加管理员</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">用户</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo site_url('user/index'); ?>">所有用户</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo site_url('user/add'); ?>">添加用户</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo site_url('memorial/index'); ?>"><i class="fa fa-columns"></i> <span class="nav-label">纪念馆管理</span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo site_url('sacrifice/index'); ?>"><i class="fa fa-columns"></i> <span class="nav-label">祭品管理</span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo site_url('comment/index'); ?>"><i class="fa fa-columns"></i> <span class="nav-label">追思管理</span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo site_url('ad/index'); ?>"><i class="fa fa-columns"></i> <span class="nav-label">广告管理</span></a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa fa-bar-chart-o"></i>
                            <span class="nav-label">广告</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo site_url('ad/index'); ?>">所有广告</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo site_url('ad/cat'); ?>">广告分类</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="<?php echo site_url('login/logout')?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo site_url('home/show'); ?>" frameborder="0" data-id="<?php echo site_url('home/show'); ?>" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">&copy; 2018-2025 <a href="/" target="_blank">追思网</a>
                </div>
            </div>
        </div>
        <!--右侧部分结束-->
    </div>

    <!-- 全局js -->
    <script src="<?php echo base_url() ?>/assets/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="<?php echo base_url() ?>/assets/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="<?php echo base_url() ?>/assets/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/js/plugins/layer/layer.min.js"></script>

    <!-- 自定义js -->
    <script src="<?php echo base_url() ?>/assets/admin/js/hplus.js?v=4.1.0"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/admin/js/contabs.js"></script>

    <!-- 第三方插件 -->
    <script src="<?php echo base_url() ?>/assets/admin/js/plugins/pace/pace.min.js"></script>

</body>

</html>
