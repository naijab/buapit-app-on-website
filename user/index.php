<?php
session_start();

if(!isset($_SESSION['user_session']))
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
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container" style="max-width:400px;">

  <h2 class="form-signin-heading">ยินดีต้อนรับเข้าสู่ระบบ</h2><hr />
  user name = <?php echo $row['user_name']; ?> <br>
  user id = <?php echo $_SESSION['user_session']; ?><br>
  user level = <?php echo $_SESSION['user_level']; ?>
  <br>
  <a href="../logout.php">ออกจากระบบ</a>

</div>
</body>
</html>
