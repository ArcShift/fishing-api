<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->config->item("app_name") ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/skins/_all-skins.min.css">
        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-- jQuery 3 -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="https://adminlte.io/themes/AdminLTE/dist/js/adminlte.min.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-46680343-1"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><?php echo $this->config->item("short_app_name") ?></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><?php echo $this->config->item("app_name") ?></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $this->session->userdata('user') ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png" class="img-circle" alt="User Image">
                                        <p><?php echo $this->session->userdata('user') ?></p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo site_url('admin/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo site_url('login/logout') ?>" class="btn btn-default btn-flat">Log out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" id="rootMenu" data-widget="tree">
                        <li class="header" >MENU</li>
                        <?php
                        $modules = array(
                            array("id" => "adm", "nama" => "Admin", "url" => "admin"),
                            array("id" => "fsrm", "nama" => "Nelayan", "url" => "nelayan"),
                            array("id" => "map", "nama" => "Peta", "url" => "peta"),
                            array("id" => "fish", "nama" => "Fish", "url" => ""),
                            array("id" => "", "nama" => "Findings", "url" => ""),
                            array("id" => "", "nama" => "Catches", "url" => "")
                        );
                        ?>
                        <?php foreach ($modules as $row) { ?>
                            <li<?php echo ' id="li' . $row['id'] . '"' ?>>
                                <a<?php echo ' id="link' . $row['id'] . '"' ?>  href="<?php echo site_url($row['url']) ?>">
                                    <i class="fa fa-circle text-primary"></i>
                                    <span><?php echo $row['nama']; ?></span>
    <!--                                    <span class="pull-right-container"<?php // echo ' id="pull' . $row['id'] . '"'   ?>>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>-->
                                </a>
                                <ul class="treeview-menu"></ul>
                            </li>
                        <?php } ?>
                    </ul>
                </section>
            </aside>
            <div class="content-wrapper">
                <?php if (isset($title)) { ?>
                    <section class="content-header">
                        <h1><?php echo $title; ?> </h1>
                        <!--      <ol class="breadcrumb">
                                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                                <li class="active">Dashboard</li>
                              </ol>-->
                    </section>
                <?php } ?>
                <section class="content">
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
                </section>
            </div>
            <footer class="main-footer">
                <strong><a href="<?php site_url('copyright'); ?>">Copyright &copy;</a></strong>
            </footer>
        </div>
        <!-- ./wrapper -->
        <script>
            $.getJSON("<?php echo site_url("adminconfig/module/getList"); ?>", null, function (r) {
                for (var i = 0; i < r.length; i++) {
                    $("#pull" + r[i].id).hide();
                    if (r[i].indukId === null) {
                    } else {
                        $("#link" + r[i].id).attr("href", $("#link" + r[i].indukId).attr("href") + "/" + r[i].nama);
                        $("#li" + r[i].indukId).addClass("treeview");
                        $("#li" + r[i].indukId + " ul").append($("#li" + r[i].id));
                        $("#pull" + r[i].indukId).show();
                    }
                }
            });
        </script>
    </body>
</html>
