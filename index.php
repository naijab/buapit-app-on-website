<?php
include 'config/db.php';

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
</head>
<body>

<div class="container" style="max-width:400px;">
<!--
  <form class="form-signin" method="post" action="login_process.php" id="register-form"> -->
<form class="form-signin" method="post" id="login-form">
            <h1>เข้าสู่ระบบ</h1><hr />

        <div id="error">
        <!-- error will be shown here ! -->
        </div>

        <div class="form-group">
        <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
        <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" name="username" id="username" />
        </div>
        </div>

        <div class="form-group">
        <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-lock"></span></div>
        <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" id="password" />
        </div>
        </div>

      <hr />

        <div class="form-group">
        <button type="submit" class="btn btn-success" name="btn-login" id="btn-login">
            <span class="glyphicon glyphicon-log-in"></span> &nbsp; เข้าสู่ระบบ
         </button>
        <button type="button" class="btn btn-info pull-right" name="btn-save" id="btn-submit">
            <span class="glyphicon glyphicon-log-in"></span> &nbsp; สมัครสมาชิก
        </button>
        </div>

      </form>


  </div>


</body>
</html>
