<!DOCTYPE html>
<html lang="en" ng-app>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIAK <?php echo isset($title) ? ' | ' . $title : null; ?></title>
        <link rel="icon" href="<?php echo media_url('ico/favicon.jpg'); ?>" type="image/x-icon">

        <!-- Bootstrap core CSS -->

        <link href="<?php echo media_url() ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo media_url() ?>/css/jquery-ui.min.css" rel="stylesheet">
        <link href="<?php echo media_url() ?>/css/jquery-ui.structure.min.css" rel="stylesheet">
        <link href="<?php echo media_url() ?>/css/jquery-ui.theme.min.css" rel="stylesheet">

        <link href="<?php echo media_url() ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo media_url() ?>/css/animate.min.css" rel="stylesheet">
    
        <link href="<?php echo media_url() ?>/css/select2.min.css" rel="stylesheet" />
        <!-- Custom styling plus plugins -->
        <link href="<?php echo media_url() ?>/css/custom.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
        <script src="<?php echo media_url() ?>/js/jquery.min.js"></script>
        <script src="<?php echo media_url(); ?>/js/angular.min.js"></script>
        <script src="<?php echo media_url(); ?>/js/mm.js"></script>

        
        <!--[if lt IE 9]>
            <script src="../assets/js/ie8-responsive-file-warning.js"></script>
            <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

        <script type="text/javascript">
            var BASEURL = '<?php echo base_url() ?>';
        </script>

    </head>


    <body class="nav-md">

        <div class="container body">


            <div class="main_container">

                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo site_url('admin') ?>" class="site_title"><i class="fa fa-windows"></i> <span>ADMIN</span></a>
                        </div>
                        <div class="clearfix"></div>

                        <br />

                        <?php $this->load->view('admin/sidebar') ?>
                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Lock">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <?php echo form_open(site_url('admin/auth/logout'), array('id' => 'formLogout')) ?>
                            <input type="hidden" name="location" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                            <a onclick="document.getElementById('formLogout').submit()" type="submit" data-toggle="tooltip" data-placement="top" title="Logout">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                            <?php echo form_close() ?>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <?php
                    if ($this->session->flashdata('success')) {
                        $data['message'] = $this->session->flashdata('success');
                        $this->load->view('admin/notification_success', $data);
                    }
                    if ($this->session->flashdata('failed')) {
                        $data['message'] = $this->session->flashdata('failed');
                        $this->load->view('admin/notification_failed', $data);
                    }
                    ?>

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo media_url() ?>/images/user.png" alt=""><?php echo $text = ucfirst($this->session->userdata('nama_lengkap')); ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li><a href="<?php echo site_url('admin/dashboard') ?>">  Home</a>
                                        </li>
                                        <li><a href="<?php echo site_url('admin/profile') ?>">  Profile</a>
                                        </li>
                                        <li>
                                        <center>
                                            <?php echo form_open(site_url('admin/auth/logout')) ?>
                                            <input type="hidden" name="location" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                                            <button class="btn btn-xs btn-danger" id="btn-lgout" type="submit">
                                                <i class="fa fa-sign-out pull-right"></i> Log out
                                            </button>
                                            <?php echo form_close() ?>
                                        </center>  
                                </li>
                            </ul>
                            </li>

                            <li role="presentation" class="dropdown">


                                </ul>
                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="row">

                        <?php isset($main) ? $this->load->view($main) : null; ?>

                        <!-- footer content -->
                        <footer class="bottom">
                            <div class="">
                                <p class="pull-right">&copy; <?php echo pretty_date(date('Y-m-d'), 'Y',FALSE) ?> Content Management System
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </footer>
                        <!-- /footer content -->

                    </div>

                </div>
            </div>

            <div id="custom_notifications" class="custom-notifications dsp_none">
                <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
                </ul>
                <div class="clearfix"></div>
                <div id="notif-group" class="tabbed_notifications"></div>
            </div>

            <script src="<?php echo media_url() ?>/js/bootstrap.min.js"></script>
            <script src="<?php echo media_url() ?>/js/jquery-ui.min.js"></script>

            <script src="<?php echo media_url() ?>/js/custom.js"></script>
            <script src="<?php echo media_url() ?>/js/jquery.nicescroll.min.js"></script>
              <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
            <script src="<?php echo media_url() ?>/js/select2.min.js"></script>
            <script>
            $("#nama").select2( {
                placeholder: "Pilih Nama",
                allowClear: true
                } );
            </script>

    </body>

</html>