
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>Source Admin | Dashboard v2</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- ================== BEGIN BASE CSS STYLE ================== -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,300,700" rel="stylesheet" id="fontFamilySrc" />
        <link href="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>assets/plugins/bootstrap/bootstrap-4.1.1/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>assets/plugins/font-awesome/5.1/css/all.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>assets/css/animate.min.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>assets/css/style.min.css" rel="stylesheet" />
        <!-- ================== END BASE CSS STYLE ================== -->

        <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
        <link href="<?php echo base_url() ?>assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
        <!-- ================== END PAGE LEVEL CSS STYLE ================== -->

        <!-- ================== BEGIN BASE JS ================== -->
        <script src="<?php echo base_url() ?>assets/plugins/pace/pace.min.js"></script>
        <!-- ================== END BASE JS ================== -->

        <!--[if lt IE 9]>
            <script src="../assets/crossbrowserjs/excanvas.min.js"></script>
        <![endif]-->
        <!-- ================== BEGIN BASE JS ================== -->
        <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url() ?>assets/plugins/bootstrap/bootstrap-4.1.1/js/bootstrap.bundle.min.js"></script>
        <!--[if lt IE 9]>
            <script src="../assets/crossbrowserjs/html5shiv.js"></script>
            <script src="../assets/crossbrowserjs/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url() ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url() ?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <!-- ================== END BASE JS ================== -->

        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
        <script src="<?php echo base_url() ?>assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
        <script src="<?php echo base_url() ?>assets/plugins/chart-js/Chart.min.js"></script>
        <script src="<?php echo base_url() ?>assets/plugins/gritter/js/jquery.gritter.js"></script>
        <script src="<?php echo base_url() ?>assets/js/page-index-v2.demo.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/demo.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/apps.min.js"></script>
        <!-- ================== END PAGE LEVEL JS ================== -->
    </head>
    <body>
        <!-- begin #page-loader -->
        <div id="page-loader" class="page-loader fade in"><span class="spinner">Loading...</span></div>
        <!-- end #page-loader -->

        <!-- begin #page-container -->
        <div id="page-container" class="fade page-container page-header-fixed page-sidebar-fixed page-with-two-sidebar page-with-footer">
            <!-- begin #header -->
            <div id="header" class="header navbar navbar-default navbar-fixed-top">
                <!-- begin container-fluid -->
                <div class="container-fluid">
                    <!-- begin mobile sidebar expand / collapse button -->
                    <div class="navbar-header">
                        <a href="<?php echo site_url()?>" class="navbar-brand"><img src="<?php echo base_url('assets/gambar/')?>logo.png" class="logo" /><?php echo $this->config->item("app_name") ?></a>
                        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- end mobile sidebar expand / collapse button -->

                    <!-- begin navbar-right -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown navbar-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="image"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png" alt="" /></span>
                                <span class="hidden-xs"><?php echo $this->session->userdata('user') ?></span> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="<?php echo site_url('admin/profile') ?>">Edit Profile</a></li>
<!--                                <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                                <li><a href="javascript:;">Calendar</a></li>
                                <li><a href="javascript:;">Setting</a></li>-->
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('login/logout') ?>">Log Out</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-click="right-sidebar-toggled">
                                <i class="fa fa-align-left"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end navbar-right -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end #header -->

            <!-- begin #sidebar -->
            <div id="sidebar" class="sidebar">
                <!-- begin sidebar scrollbar -->
                <div data-scrollbar="true" data-height="100%">
                    <!-- begin sidebar nav -->
                    <ul class="nav">
                        <li class="nav-user">
                            <div class="image">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png" alt="" />
                            </div>
                            <div class="info">
                                <div class="name dropdown">
                                    <a href="javascript:;" data-toggle="dropdown"><?php echo $this->session->userdata('user') ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo site_url('admin/profile') ?>">Edit Profile</a></li>
                                        <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                                        <li><a href="javascript:;">Calendar</a></li>
                                        <li><a href="javascript:;">Setting</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo site_url('login/logout') ?>">Log Out</a></li>
                                    </ul>
                                </div>
                                <div class="position"><?php echo $this->session->userdata('role') ?></div>
                            </div>
                        </li>
                        <li class="nav-header">Navigation</li>
                        <?php
                        $modules = array(
                            array("id" => "adm", "nama" => "admin", "url" => "admin", "icon"=>"user-secret"),
                            array("id" => "fsrm", "nama" => "nelayan", "url" => "nelayan", "icon"=>"user"),
                            array("id" => "map", "nama" => "peta", "url" => "peta", "icon"=>"map-marked"),
                            array("id" => "fish", "nama" => "Ikan", "url" => "ikan", "icon"=>"fish"),
                            array("id" => "cmpl", "nama" => "Pengaduan", "url" => "pengaduan", "icon"=>"phone-volume"),
//                            array("id" => "", "nama" => "Findings", "url" => "", "icon"=>"cogs"),
//                            array("id" => "", "nama" => "Catches", "url" => "", "icon"=>"shopping-basket")
                        );
                        ?>
                        <?php foreach ($modules as $m) { ?>
                        <li class="<?php echo $m['url']==$this->uri->segment(1)?'active':'' ?>">
                                <a href="<?php echo site_url($m['url']) ?>">
                                    <i class="fa fa-<?php echo $m['icon']?>"></i>
                                    <span><?php echo ucfirst($m['nama']) ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="divider has-minify-btn">
                            <!-- begin sidebar minify button -->
                            <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-left"></i></a>
                            <!-- end sidebar minify button -->
                        </li>
                    </ul>
                    <!-- end sidebar nav -->
                </div>
                <!-- end sidebar scrollbar -->
            </div>
            <div class="sidebar-bg"></div>
            <!-- end #sidebar -->

            <!-- begin #content -->
            <div id="content" class="content">
                <!-- begin breadcrumb -->
<!--                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                    <li class="breadcrumb-item active">Dashboard v2</li>
                </ol>-->
                <!-- end breadcrumb -->
                <!-- begin page-header -->
                <h1 class="page-header"><?php echo ucfirst($title) ?> <small><?php echo ucfirst($subTitle) ?></small></h1>
                <!-- end page-header -->
                <?php if (!empty($this->session->flashdata('msgSuccess'))) { ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-thumbs-o-up"></i> Sukses</h4>
                        <?php echo $this->session->flashdata('msgSuccess') ?>
                    </div>
                <?php } else if (!empty($this->session->flashdata('msgError'))) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                        <?php echo $this->session->flashdata('msgError') ?>
                    </div>
                <?php } ?>
                <?php $this->load->view($view) ?>

                <!-- begin #footer -->
                <div id="footer" class="footer">
                    <span class="pull-right">
                        <a href="javascript:;" class="btn-scroll-to-top" data-click="scroll-top">
                            <i class="fa fa-arrow-up"></i> <span class="hidden-xs">Back to Top</span>
                        </a>
                    </span>
                    &copy; 2018 <b>Source Admin</b> All Right Reserved
                </div>
                <!-- end #footer -->
            </div>
            <!-- end #content -->

            <!-- begin #sidebar-right -->
            <div id="sidebar-right" class="sidebar sidebar-right">
                <!-- begin sidebar scrollbar -->
                <div data-scrollbar="true" data-height="100%">
                    <!-- begin sidebar-nav -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="width-half"><a class="active" href="#today" data-toggle="tab">Today</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="today">
                            <ul class="nav">
                                <li class="nav-date">
                                    Sunday, May 31 st
                                </li>
                                <li class="divider"></li>
                                <li class="divider"></li>
                                <li class="divider"></li>
                                <li class="nav-header">Calendar</li>
                                <li>
                                    <div id="schedule-calendar"></div>
                                </li>
                                <li class="divider"></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end sidebar-nav -->
                </div>
                <!-- end sidebar scrollbar -->
            </div>
            <div class="sidebar-bg sidebar-right"></div>
            <!-- end #sidebar-right -->
        </div>
        <!-- end page container -->

        <!-- begin theme-panel -->
        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-tint"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">Font Family</h5>
                <div class="row row-space-10">
                    <div class="col-lg-12">
                        <a href="#" class="btn btn-default btn-block btn-sm m-b-10 active" data-value="" data-src="" data-click="body-font-family">
                            Default
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="#" class="btn btn-default btn-block btn-sm m-b-10" data-value="font-nunito" data-src="https://fonts.googleapis.com/css?family=Nunito:400,300,700" data-click="body-font-family">
                            Nunito
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="#" class="btn btn-default btn-block btn-sm m-b-10" data-value="font-open-sans" data-src="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" data-click="body-font-family">
                            Open Sans
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="#" class="btn btn-default btn-block btn-sm m-b-10" data-value="font-roboto" data-src="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" data-click="body-font-family">
                            Roboto
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="#" class="btn btn-default btn-block btn-sm m-b-10" data-value="font-lato" data-src="https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900" data-click="body-font-family">
                            Lato
                        </a>
                    </div>
                    <div class="col-lg-12">
                        <a href="#" class="btn btn-default btn-block btn-sm text-ellipsis" data-value="font-helvetica-arial" data-src="" data-click="body-font-family">
                            Helvetica Neue, Helvetica , Arial
                        </a>
                    </div>
                </div>
                <div class="horizontal-divider"></div>
                <h5 class="m-t-0">Header Theme</h5>
                <ul class="theme-list clearfix">
                    <li><a href="javascript:;" class="bg-inverse" data-value="navbar-inverse" data-click="header-theme-selector" data-toggle="tooltip" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-grey" data-value="navbar-grey" data-click="header-theme-selector" data-toggle="tooltip" data-title="Grey">&nbsp;</a></li>
                    <li class="active"><a href="javascript:;" class="bg-white" data-value="navbar-default" data-click="header-theme-selector" data-toggle="tooltip" data-title="Light">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-value="navbar-purple" data-click="header-theme-selector" data-toggle="tooltip" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-primary" data-value="navbar-primary" data-click="header-theme-selector" data-toggle="tooltip" data-title="Primary">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-success" data-value="navbar-success" data-click="header-theme-selector" data-toggle="tooltip" data-title="Success">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-lime" data-value="navbar-lime" data-click="header-theme-selector" data-toggle="tooltip" data-title="Lime">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-warning" data-value="navbar-warning" data-click="header-theme-selector" data-toggle="tooltip" data-title="Warning">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-danger" data-value="navbar-danger" data-click="header-theme-selector" data-toggle="tooltip" data-title="Danger">&nbsp;</a></li>
                </ul>
                <div class="horizontal-divider"></div>
                <h5 class="m-t-0">Sidebar Highlight Color</h5>
                <ul class="theme-list clearfix">
                    <li><a href="javascript:;" class="bg-inverse" data-value="sidebar-highlight-inverse" data-click="sidebar-highlight-selector" data-toggle="tooltip" data-title="Inverse">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-grey" data-value="sidebar-highlight-grey" data-click="sidebar-highlight-selector" data-toggle="tooltip" data-title="Grey">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-white" data-value="sidebar-highlight-light" data-click="sidebar-highlight-selector" data-toggle="tooltip" data-title="Light">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-value="sidebar-highlight-purple" data-click="sidebar-highlight-selector" data-toggle="tooltip" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-primary" data-value="sidebar-highlight-primary" data-click="sidebar-highlight-selector" data-toggle="tooltip" data-title="Primary">&nbsp;</a></li>
                    <li class="active"><a href="javascript:;" class="bg-success" data-value="" data-click="sidebar-highlight-selector" data-toggle="tooltip" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-lime" data-value="sidebar-highlight-lime" data-click="sidebar-highlight-selector" data-toggle="tooltip" data-title="Lime">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-warning" data-value="sidebar-highlight-warning" data-click="sidebar-highlight-selector" data-toggle="tooltip" data-title="Warning">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-danger" data-value="sidebar-highlight-danger" data-click="sidebar-highlight-selector" data-toggle="tooltip" data-title="Danger">&nbsp;</a></li>
                </ul>
                <div class="horizontal-divider"></div>
                <h5 class="m-t-0">Sidebar Theme</h5>
                <ul class="theme-list clearfix">
                    <li class="active"><a href="javascript:;" class="bg-inverse" data-value="" data-click="sidebar-theme-selector" data-toggle="tooltip" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-grey" data-value="sidebar-grey" data-click="sidebar-theme-selector" data-toggle="tooltip" data-title="Grey">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-white" data-value="sidebar-light" data-click="sidebar-theme-selector" data-toggle="tooltip" data-title="Light">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-value="sidebar-purple" data-click="sidebar-theme-selector" data-toggle="tooltip" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-primary" data-value="sidebar-primary" data-click="sidebar-theme-selector" data-toggle="tooltip" data-title="Primary">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-success" data-value="sidebar-success" data-click="sidebar-theme-selector" data-toggle="tooltip" data-title="Success">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-lime" data-value="sidebar-lime" data-click="sidebar-theme-selector" data-toggle="tooltip" data-title="Lime">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-warning" data-value="sidebar-warning" data-click="sidebar-theme-selector" data-toggle="tooltip" data-title="Warning">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-danger" data-value="sidebar-danger" data-click="sidebar-theme-selector" data-toggle="tooltip" data-title="Danger">&nbsp;</a></li>
                </ul>
            </div>
        </div>
        <!-- end theme-panel -->
        <script>
            $(document).ready(function () {
                App.init();
                Demo.init();
                PageDemo.init();
            });
        </script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-53034621-1', 'auto');
            ga('send', 'pageview');

        </script>
    </body>
</html>
