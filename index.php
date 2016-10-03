<?php

  require_once 'config/db.php';

?>
    <!doctype>
    <html>
    <head>
        <meta charset="utf-8">
        <title>หน้าแรก : เข้าสู่ระบบ</title>
        <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
        <script type="text/javascript" src="js/validation.min.js"></script>
        <script type="text/javascript" src="js/script_login.js"></script>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <!-- Bootstrap Core Css -->
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Waves Effect Css -->
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <!-- Animation Css -->
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <!-- Preloader Css -->
        <link href="plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />
        <!-- Morris Chart Css-->
        <link href="plugins/morrisjs/morris.css" rel="stylesheet" />
        <!-- Custom Css -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> </head>

    <body>
        <div class="container" style="max-width:400px;">
            <!--
  <form class="form-signin" method="post" action="login_process.php" id="register-form"> -->
            <form class="form-signin" method="post" id="login-form">
                <h1>เข้าสู่ระบบ</h1>
                <hr />
                <div id="error">
                    <!-- error will be shown here ! -->
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                        <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" name="username" id="username" /> </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-lock"></span></div>
                        <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" id="password" /> </div>
                </div>
                <hr />
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="btn-login" id="btn-login"> <span class="glyphicon glyphicon-log-in"></span> &nbsp; เข้าสู่ระบบ </button>
                    <a href="join.php" class="btn btn-info pull-right"> <span class="glyphicon glyphicon-log-in"></span> &nbsp; สมัครสมาชิก </a>
                </div>
            </form>
        </div>
        <!-- Jquery Core Js -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap Core Js -->
        <script src="../plugins/bootstrap/js/bootstrap.js"></script>
        <!-- Select Plugin Js -->
        <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>
        <!-- Slimscroll Plugin Js -->
        <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <!-- Waves Effect Plugin Js -->
        <script src="../plugins/node-waves/waves.js"></script>
        <!-- Jquery CountTo Plugin Js -->
        <script src="../plugins/jquery-countto/jquery.countTo.js"></script>
        <!-- Morris Plugin Js -->
        <script src="../plugins/raphael/raphael.min.js"></script>
        <script src="../plugins/morrisjs/morris.js"></script>
        <!-- ChartJs -->
        <script src="../plugins/chartjs/Chart.bundle.js"></script>
        <!-- Flot Charts Plugin Js -->
        <script src="../plugins/flot-charts/jquery.flot.js"></script>
        <script src="../plugins/flot-charts/jquery.flot.resize.js"></script>
        <script src="../plugins/flot-charts/jquery.flot.pie.js"></script>
        <script src="../plugins/flot-charts/jquery.flot.categories.js"></script>
        <script src="../plugins/flot-charts/jquery.flot.time.js"></script>
        <!-- Sparkline Chart Plugin Js -->
        <script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>
        <!-- Custom Js -->
        <script src="../js/admin.js"></script>
        <script src="../js/pages/index.js"></script>
        <!-- Demo Js -->
        <script src="../js/demo.js"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                $('#example').DataTable();
                $('#example').removeClass('display').addClass('table table-bordered');
            });
        </script>
    </body>

    </html>
