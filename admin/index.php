<?php
session_start();

if($_SESSION['user_level']!="700"){
  header("Location: ../user/index.php");
}
else if(!isset($_SESSION['user_session']))
{
  header("Location: ../index.php");
}

include_once '../config/db.php';

  $stmt = $db_con->prepare("UPDATE buapit_user SET user_last_update = NOW() WHERE user_id=:uname");
  $stmt->execute(array(":uname"=>$_SESSION['user_session']));

  $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_id=:uid");
  $stmt->execute(array(":uid"=>$_SESSION['user_session']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<html>
<head>
<meta charset="utf-8">
<title>หน้าสมาชิก</title>
<script type="text/javascript" src="../js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>
<!-- Bootstrap Core Css -->
<link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="../plugins/node-waves/waves.css" rel="stylesheet" />

<!-- Animation Css -->
<link href="../plugins/animate-css/animate.css" rel="stylesheet" />

<!-- Preloader Css -->
<link href="../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

<!-- Morris Chart Css-->
<link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

<!-- Custom Css -->
<link href="../css/style.css" rel="stylesheet">
<link href="../css/themes/all-themes.css" rel="stylesheet" />
</head>
<body>
<div class="container" style="max-width:400px;">

  <h2 class="form-signin-heading">ยินดีต้อนรับ: ผู้ดูแลระบบ</h2><hr />
  user name = <?php echo $row['user_name']; ?> <br>
  user id = <?php echo $_SESSION['user_session']; ?> <br>
  user level = <?php echo $_SESSION['user_level']; ?>
  <br>
  <a href="../logout.php">ออกจากระบบ</a>

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
</body>
</html>
