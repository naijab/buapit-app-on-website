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
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>หน้าสมาชิก : จัดการข่าวสารประชาสัมพันธ์ > เพิ่มข่าวสาร</title>
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

   <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

</head>
<body class="theme-pink">

      <!-- Overlay For Sidebars -->
      <div class="overlay"></div>
      <!-- #END# Overlay For Sidebars -->
      <!-- Search Bar -->
      <div class="search-bar">
          <div class="search-icon">
              <i class="material-icons">search</i>
          </div>
          <input type="text" placeholder="START TYPING...">
          <div class="close-search">
              <i class="material-icons">close</i>
          </div>
      </div>
      <!-- #END# Search Bar -->
      <!-- Top Bar -->
      <nav class="navbar">
          <div class="container-fluid">
              <div class="navbar-header">
                  <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                  <a href="javascript:void(0);" class="bars"></a>
                  <a class="navbar-brand" href="index.html">ระบบจัดการแอพพลิเคชั่น Buapit</a>
              </div>
              <div class="collapse navbar-collapse" id="navbar-collapse">
                  <ul class="nav navbar-nav navbar-right">
                      <!-- Call Search -->
                      <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                      <!-- #END# Call Search -->
                      <li><a href="../logout.php">ออกจากระบบ</a></li>

                  </ul>
              </div>
          </div>
      </nav>
      <!-- #Top Bar -->
      <section>
          <!-- Left Sidebar -->
          <aside id="leftsidebar" class="sidebar">
              <!-- User Info -->
              <div class="user-info">
                  <div class="image">

                  </div>
                  <div class="info-container">
                      <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $row['user_name']; ?></div>
                      <div class="btn-group user-helper-dropdown">
                          <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                          <ul class="dropdown-menu pull-right">
                              <li><a href="javascript:void(0);"><i class="material-icons">person</i>แก้ไขข้อมูลส่วนตัว</a></li>
                              <li role="seperator" class="divider"></li>
                              <li><a href="../logout.php"><i class="material-icons">input</i>ออกจากระบบ</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
              <!-- #User Info -->
              <!-- Menu -->
              <div class="menu">
                  <ul class="list">
                      <li class="header">เมนูหลัก</li>
                      <li>
                          <a href="index.php">
                              <i class="material-icons">home</i>
                              <span>หน้าแรก</span>
                          </a>
                      </li>
                      <li>
                          <a href="javascript:void(0);" class="menu-toggle">
                              <i class="material-icons">recent_actors</i>
                              <span>จัดการข้อมูลโรงเรียน</span>
                          </a>
                          <ul class="ml-menu">
                                      <li>
                                          <a href="school_data.php">ข้อมูลโรงเรียน</a>
                                      </li>
                                      <li>
                                          <a href="school_person.php">ข้อมูลบุคลากร</a>
                                      </li>
                                      <li>
                                          <a href="school_student.php">ข้อมูลนักเรียน</a>
                                      </li>
                            </ul>
                      </li>
                      <li class="active">
                          <a href="javascript:void(0);" class="menu-toggle">
                              <i class="material-icons">chat</i>
                              <span>จัดการข่าวสารประชาสัมพันธ์</span>
                          </a>
                              <ul class="ml-menu">
                                      <li>
                                          <a href="news_student.php">นักเรียน</a>
                                      </li>
                                      <li>
                                          <a href="news_teacher.php">คุณครู</a>
                                      </li>
                                      <li>
                                          <a href="news_finance.php">ธุรการ / พัสดุ / การเงิน</a>
                                      </li>
                               </ul>
                          </li>
                          <li>
                              <a href="javascript:void(0);" class="menu-toggle">
                                  <i class="material-icons">assistant</i>
                                  <span>จัดการรางวัล</span>
                              </a>
                              <ul class="ml-menu">
                                          <li>
                                              <a href="portfolio_edu.php">วิชาการ</a>
                                          </li>
                                          <li>
                                              <a href="portfolio_sport.php">กีฬา</a>
                                          </li>
                                          <li>
                                              <a href="portfolio_good.php">คุณธรรม</a>
                                          </li>
                                </ul>
                          </li>
                          <li>
                              <a href="javascript:void(0);" class="menu-toggle">
                                  <i class="material-icons">today</i>
                                  <span>จัดการปฏิทินกิจกรรม</span>
                              </a>
                              <ul class="ml-menu">
                                          <li>
                                              <a href="calendar_1.php">เทอมเรียน 1</a>
                                          </li>
                                          <li>
                                              <a href="calendar_2.php">เทอมเรียน 2</a>
                                          </li>
                                </ul>
                          </li>
                  </ul>
              </div>
              <!-- #Menu -->
              <!-- Footer -->
              <div class="legal">
                  <div class="copyright">
                      &copy; 2016 <a href="javascript:void(0);">ระบบจัดการแอพพลิเคชั่น Buapit</a>.
                  </div>
                  <div class="version">
                      <b>Version: </b> 1.0.0
                  </div>
              </div>
              <!-- #Footer -->
          </aside>
          <!-- #END# Left Sidebar -->
      </section>

      <section class="content">
          <div class="container-fluid">

              <div class="row clearfix">
                  <!-- Content Main -->
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="card">
                          <div class="header bg-orange">
                              <h2>จัดการข่าวสารประชาสัมพันธ์ > เพิ่มข่าวสาร</h2>
                              <ul class="header-dropdown m-r--5">
                                  <li class="dropdown">
                                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                          <i class="material-icons">more_vert</i>
                                      </a>
                                      <ul class="dropdown-menu pull-right">
                                          <li><a href="javascript:void(0);">Action</a></li>
                                          <li><a href="javascript:void(0);">Another action</a></li>
                                          <li><a href="javascript:void(0);">Something else here</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </div>
                          <div class="body">

<div id="display">
    <!-- here message will be displayed -->
 </div>

 <form method='post' id='news-SaveForm' action="#">


              <div class="form-group form-float">
                <div class="form-line">
                  <input type='text' name='title' class='form-control' placeholder='' required />
                  <label class="form-label">ชื่อเรื่อง</label>
                </div>
              </div>

              <div class="form-group form-float">
                <div class="form-line">
                  <input id="input-id" type="file" class="form-control" data-preview-file-type="text" >
                
                </div>
              </div>

              <div class="form-group form-float">
                <div class="form-line">
                  <input type='text' name='sh_news' class='form-control' placeholder='' required />
                  <label class="form-label">คำอธิบาย</label>
                </div>
              </div>

  <textarea rows="20" style="overflow-y: scroll; resize: none;" cols="50" name='full_news' class='form-control' required placeholder='ใส่เนื้อข่าว' ></textarea>


   <button type="submit" class="btn btn-primary" name="btn-save" id="btn-save">
      <span class="glyphicon glyphicon-plus"></span> เพิ่มข่าวสาร
   </button>

</form>

                          </div>
                      </div>
                  </div>
                  <!-- #END# Task Info -->
              </div>
          </div>
      </section>

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
        $(document).ready(function() {
         $('#example').DataTable();

         $('#example')
         .removeClass( 'display' )
         .addClass('table table-bordered');
        });
     </script>
</body>
</html>
