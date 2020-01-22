<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>CMS</title>

        <link rel="icon" href="<?php echo base_url('media/ico/favicon.png'); ?>" type="image/x-icon">

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url() ?>media/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url() ?>media/css/backend-styles.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <!--<link href="<?php // echo base_url()     ?>media/font/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

   <body role="login">
        <br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-offset-3">
                    <div class="login-panel">
                        <span class="pull-left" style="margin-top: 50px; margin-left: 8px" >
                            <img class="img-rounded img-responsive" style="width: 170px" >
                        </span>
                        <div class=" panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">CMS | LOGIN</h3>
                            </div>
                            <div class="panel-body">
                                <img src="">
                                <form role="form" action="<?php echo site_url('admin/auth/login') ?>" method="post">
                                    <?php
                                    echo form_open(current_url(), array('role' => 'form', 'class' => 'form-signin'));
                                    if (isset($_GET['location'])) {
                                        echo '<input type="hidden" name="location" value="';
                                        if (isset($_GET['location'])) {
                                            echo htmlspecialchars($_GET['location']);
                                        }
                                        echo '" />';
                                    }
                                    ?>
                                    <fieldset>
                                        <div class="form-group">
                                            <input class="form-control" required placeholder="Username" name="username" type="text" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" required placeholder="Password" name="password" type="password"  required>
                                        </div>
                                        <!-- Change this to a button or input when using this as a form -->
                                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                                        <br>
                                        <h3 class="panel-title"><center>&copy; <?php echo pretty_date(date('Y-m-d'), 'Y',FALSE) ?> | Achyar Anshorie&trade;</center></h3>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php if ($this->session->flashdata('failed')) { ?>
                        <div class="alert alert-warning"><center><?php echo $this->session->flashdata('failed')?></center></div>
                            <?php } ?>
                </div>
            </div>
        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="<?php echo base_url() . 'media/js/jquery-1.11.2.min.js' ?>"></script>

        <!-- jQuery-ui -->
        <script src="<?php echo base_url() . 'media/js/jquery-ui.min.js' ?>"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url() . 'media/js/bootstrap.min.js' ?>"></script>

        <!-- Custom Theme JavaScript -->
        <!--<script src="<?php // echo base_url().'media/js/backend-js.js'     ?>"></script>-->

    </body>

</html>
