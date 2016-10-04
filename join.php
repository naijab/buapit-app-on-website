<?php
  require_once 'config/db.php';
  $web_font = "font-family: 'Athiti', sans-serif;";
?>
<html>
<head>
    <meta charset="utf-8">
    <title>สมัครสมาชิก</title>
    <script type="text/javascript" src="js/check-username.js"></script>
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript" src="js/script_join.js"></script>
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
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  </head>

<body>
    <div class="container" style="max-width:400px; <?= $web_font ?>">
      <div class="card" tyle="max-width:400px; padding:20px; margin:60px 0 0 0;">
        <div class="container" style="max-width:350px; padding:10px;">
        <form class="form-signin" method="post" action="register_process" id="register-form" autocomplete="off">
            <h2 class="form-signin-heading">ฟอร์มสมัครสมาชิก</h2>
            <hr />
            <div id="error">
                <!-- error will be showen here ! -->
            </div>
            <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <label class="form-label">รหัสโรงเรียน 10 หลัก</label>
              <div class="form-line">
                <input type="text" class="form-control" placeholder="ใส่รหัสโรงเรียน 10 หลัก" name="code" id="code" />
              </div>
            </div>
            </div>

            <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <label class="form-label">ชื่อโรงเรียน (เช่น โรงเรียนหนองบัวพิทยาคาร)</label>
              <div class="form-line">
                <input type="text" class="form-control" placeholder="ใส่ชื่อโรงเรียน" name="school" id="school" />
              </div>
            </div>
            </div>

            <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <label class="form-label">ชื่อผู้ใช้ username</label>
              <div class="form-line">
                <input type="text" class="form-control" placeholder="ใส่ชื่อผู้ใช้" name="username" id="username" />
              </div><span id="check-username"></span>
            </div>
            </div>

            <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <label class="form-label">ชื่อ - สกุล</label>
              <div class="form-line">
                <input type="text" class="form-control" placeholder="ใส่ชื่อ - สกุล" name="fullname" id="fullname" />
              </div>
            </div>
            </div>

            <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <label class="form-label">ตำแหน่ง</label>
              <div class="form-line">
                <input type="text" class="form-control" placeholder="ใส่ตำแหน่ง" name="position" id="position" />
              </div>
            </div>
            </div>

            <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <label class="form-label">อีเมลล์</label>
              <div class="form-line">
                <input type="email" class="form-control" placeholder="ใส่อีเมลล์" name="email" id="email" />
              </div>
            </div>
            </div>

            <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <label class="form-label">เบอร์โทรศัพท์</label>
              <div class="form-line">
                <input type="text" class="form-control" placeholder="ใส่เบอร์โทรศัพท์" name="tel" id="tel" />
              </div>
            </div>
            </div>

            <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <label class="form-label">รหัสผ่าน (8 ตัวขึ้นไป)</label>
              <div class="form-line">
                <input type="password" class="form-control" placeholder="ใส่รหัสผ่าน" name="password" id="password" />
              </div>
            </div>
            </div>

            <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <label class="form-label">ใส่รหัสผ่านซ้ำ</label>
              <div class="form-line">
                <input type="password" class="form-control" placeholder="ใส่รหัสผ่านซ้ำ" name="cpassword" id="cpassword" />
              </div>
            </div>
            </div>

            <hr />
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg pull-right" name="btn-save" id="btn-submit"> <span class="glyphicon glyphicon-ok-circle"></span> &nbsp; สมัครสมาชิก </button>
                <a href="index" class="btn btn-danger btn-lg"> <span class="glyphicon glyphicon-remove-circle"></span> &nbsp; ยกเลิก </a>
            </div>
        </form>
        </div>
      </div>
    </div>
</body>

</html>
