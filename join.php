<html>
<head>
<meta charset="utf-8">
<title>สมัครสมาชิก</title>
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript" src="js/script_join.js"></script>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container" style="max-width:400px;">
  <form class="form-signin" method="post" id="register-form">

          <h2 class="form-signin-heading">ฟอร์ม</h2><hr />

          <div id="error">
          <!-- error will be showen here ! -->
          </div>

          <div class="form-group">
          <input type="text" class="form-control" placeholder="Username" name="username" id="username" />
          <span id="check-e"></span>
          </div>

          <div class="form-group">
          <input type="text" class="form-control" placeholder="Full name" name="fullname" id="fullname" />
          </div>

          <div class="form-group">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
          </div>

          <div class="form-group">
          <input type="password" class="form-control" placeholder="Re-Password" name="cpassword" id="cpassword" />
          </div>

        <hr />

          <div class="form-group">
        <button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">
          <span class="glyphicon glyphicon-log-in"></span> &nbsp; สมัครสมาชิก
        </button>
          </div>

        </form>
</div>
</body>
</html>
