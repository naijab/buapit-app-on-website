<html>

<head>
    <meta charset="utf-8">
    <title>สมัครสมาชิก</title>
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript" src="js/script_join.js"></script>
    <script type="text/javascript" src="js/check-username.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> </head>

<body>
    <div class="container" style="max-width:400px;">
        <form class="form-signin" method="post" action="register_process.php" id="register-form" autocomplete="off">
            <h2 class="form-signin-heading">ฟอร์มสมัครสมาชิก</h2>
            <hr />
            <div id="error">
                <!-- error will be showen here ! -->
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" /> </div> <span id="check-username"></span> </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-lock"></span></div>
                    <input type="text" class="form-control" placeholder="Full name" name="fullname" id="fullname" /> </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-lock"></span></div>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" /> </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-lock"></span></div>
                    <input type="password" class="form-control" placeholder="Re-Password" name="cpassword" id="cpassword" /> </div>
            </div>
            <hr />
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="btn-save" id="btn-submit"> <span class="glyphicon glyphicon-ok-circle"></span> &nbsp; สมัครสมาชิก </button>
                <a href="index.php" class="btn btn-danger pull-right"> <span class="glyphicon glyphicon-remove-circle"></span> &nbsp; ยกเลิก </a>
            </div>
        </form>
    </div>
</body>

</html>