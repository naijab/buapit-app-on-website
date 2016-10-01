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
<title>หน้าสมาชิก : จัดการข่าวสารประชาสัมพันธ์ > นักเรียน</title>
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
   <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

</head>
<body class="theme-pink">

  <!-- Page Loader -->
      <div class="page-loader-wrapper">
          <div class="loader">
              <div class="md-preloader pl-size-md">
                  <svg viewbox="0 0 75 75">
                      <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                  </svg>
              </div>
              <p>กรุณารอสักครู่...</p>
          </div>
      </div>
      <!-- #END# Page Loader -->
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
                                      <li  class="active">
                                          <a href="news_all.php">ทั้งหมด</a>
                                      </li>
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
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table_content">
                      <div class="card">
                          <div class="header bg-orange">
                              <h2>จัดการข่าวสารประชาสัมพันธ์ > ทั้งหมด <?php echo date("Y-m-d H:i:s");?>
                              </h2>
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


                                  <br><br>
                                  <button class="btn btn-success waves-effect waves-float" data-toggle="modal" data-target="#add_new_record_modal">สร้างใหม่</button>

                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- #END# Task Info -->

                  <!-- Bootstrap Modal - To Add New Record -->
                  <!-- Modal -->
    <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">สร้างข่าวใหม่</h4>
                  </div>
                  <div class="modal-body">
              <!--Add form-->
                <form action="lib/add_news.php" enctype="multipart/form-data" method="post" >
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="form-label">ชื่อเรื่อง</label>
                        <div class="form-line">
                            <input type='text' name='title' id='title' class='form-control' placeholder='ใส่ชื่อเรื่อง' required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label class="form-label">เลือกประเภท</label>
                            <select class="form-control" name="type" id="type" required>
                              <option value="ทั่วไป">ทั่วไป</option>
                              <option value="นักเรียน">นักเรียน</option>
                              <option value="คุณครู">คุณครู</option>
                              <option value="วิชาการ">วิชาการ</option>
                              <option value="รางวัลและการแข่งขัน">รางวัลและการแข่งขัน</option>
                              <option value="การเงิน / ธุรการ">การเงิน / ธุรการ</option>
                            </select>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="form-label">เนื้อข่าว</label>
                      <div class="form-line">
                        <textarea type='text' id='content' name='content' class='form-control' placeholder='ใส่เนื้อเรื่อง' rows="10" cols="20" style="overflow-y: scroll; resize: none;" required></textarea>
                    </div>
                  </div>
                <div class="row">
                  <div class="form-group">
                      <div class="col-md-9">
                        <label class="form-label">รูปภาพ</label>
                        <div class="form-line">
                          <input type="file" id='image' name='image' class='form-control' placeholder='' required />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <input name="active" id="active1" type="radio" class="rad-active with-gap radio-col-green" value="1" >
                                <label for="active1">เผยแพร่</label>
                        <input name="active" id="active2" type="radio" class="rad-active with-gap radio-col-red" value="0" >
                              <label for="active2">ไม่เผยแพร่</label>
                      </div>
                  </div>
                </div>

                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">ยกเลิก</button>
                  <button type="submit" class="btn btn-primary btn-lg">บันทึก</button>
                </form>
                  </div>
                  </div>
                  </div>
                  </div>

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
      <!-- Sparkline Chart Plugin Js -->
      <script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>
      <!-- Custom Js -->
      <script src="../js/admin.js"></script>
      <script src="../js/pages/index.js"></script>
      <!-- Crud JS -->
      <script src="js/crud.js"></script>
      <!-- Demo Js
      <script src="../js/demo.js"></script>
      <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
         $('#example').DataTable();

         $('#example')
         .removeClass( 'display' )
         .addClass('table table-bordered');
        });
     </script> -->

     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>


</body>
</html>
