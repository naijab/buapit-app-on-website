<?php
session_start();

if(!isset($_SESSION['user_session']))
{
 header("Location: ../index.php");
}

require_once '../config/db.php';


  //อัพเดตเวลาล็อกอิน
  $stmt = $db_con->prepare("UPDATE buapit_user SET user_last_update = NOW() WHERE user_id=:uname");
  $stmt->execute(array(":uname"=>$_SESSION['user_session']));

  //ดึงข้อมูลจากตารางผู้ใช้
  $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_id=:uid");
  $stmt->execute(array(":uid"=>$_SESSION['user_session']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);

  $stmt_news = $db_con->prepare("SELECT * FROM buapit_news WHERE news_by_user=:uid");
  $stmt_news->execute(array(":uid"=>$row['user_id']));
  $row_news=$stmt_news->fetch(PDO::FETCH_ASSOC);
  $row_cout_news = $stmt_news->rowCount();

?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php require_once '../config/web_config.php';?>
<title><?= $web_title; ?> หน้าสมาชิก</title>
</head>
<body class="<?= $web_theme; ?>" style="<?= $web_font; ?>">

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
                  <a class="navbar-brand" href="index.html"><b>ระบบจัดการแอพพลิเคชั่น Buapit</b></a>
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
                      <li class="active">
                          <a href="index.php">
                              <i class="material-icons">home</i>
                              <span>หน้าแรก</span>
                          </a>
                      </li>
                      <li>
                          <a href="school_data.php">
                              <i class="material-icons">recent_actors</i>
                              <span>จัดการข้อมูลโรงเรียน</span>
                          </a>
                      </li>
                      <li>
                          <a href="news_all.php">
                              <i class="material-icons">chat</i>
                              <span>จัดการข่าวสารประชาสัมพันธ์</span>
                          </a>
                      </li>
                      <li>
                          <a href="calendar.php">
                              <i class="material-icons">today</i>
                              <span>จัดการปฏิทินกิจกรรม</span>
                          </a>
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
              <div class="block-header">
                  <h1>จัดการระบบ แอพพลิเคชันโรงเรียน (SADA.OS)</h1>
              </div>

              <!-- Widgets -->
              <div class="row clearfix">
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box bg-pink hover-expand-effect">
                          <div class="icon">
                              <i class="material-icons">chat</i>
                          </div>
                          <div class="content">
                              <div class="text" style="font-size:16px;">ข่าวประชาสัมพันธ์</div>
                              <div class="number count-to" data-from="0" data-to="" data-speed="15" data-fresh-interval="20"><?php echo $row_cout_news; ?></div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box bg-cyan hover-expand-effect">
                          <div class="icon">
                              <i class="material-icons">help</i>
                          </div>
                          <div class="content">
                             <div class="text" style="font-size:16px;">ใบขออนุญาติ</div>
                             <div class="number count-to" data-from="0" data-to="" data-speed="15" data-fresh-interval="20"><?php echo $row_cout_news; ?></div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box bg-light-green hover-expand-effect">
                          <div class="icon">
                              <i class="material-icons">forum</i>
                          </div>
                          <div class="content">
                             <div class="text" style="font-size:16px;">ไฟล์ดาวน์โหลด</div>
                             <div class="number count-to" data-from="0" data-to="" data-speed="15" data-fresh-interval="20"><?php echo $row_cout_news; ?></div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box bg-orange hover-expand-effect">
                          <div class="icon">
                              <i class="material-icons">person_add</i>
                          </div>
                          <div class="content">
                             <div class="text" style="font-size:16px;">ข้อความแจ้งเตือน</div>
                             <div class="number count-to" data-from="0" data-to="" data-speed="15" data-fresh-interval="20"><?php echo $row_cout_news; ?></div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- #END# Widgets -->
              <div class="row clearfix">
                  <!-- Visitors -->
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                      <div class="card">
                          <div class="body bg-pink">
                              <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                                   data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                                   data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                                   data-fill-Color="rgba(0, 188, 212, 0)">
                                  12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                              </div>
                              <ul class="dashboard-stat-list">
                                  <li>
                                      TODAY
                                      <span class="pull-right"><b>1 200</b> <small>USERS</small></span>
                                  </li>
                                  <li>
                                      YESTERDAY
                                      <span class="pull-right"><b>3 872</b> <small>USERS</small></span>
                                  </li>
                                  <li>
                                      LAST WEEK
                                      <span class="pull-right"><b>26 582</b> <small>USERS</small></span>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <!-- #END# Visitors -->
                  <!-- Latest Social Trends -->
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                      <div class="card">
                          <div class="body bg-cyan">
                              <div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
                              <ul class="dashboard-stat-list">
                                  <li>
                                      #socialtrends
                                      <span class="pull-right">
                                          <i class="material-icons">trending_up</i>
                                      </span>
                                  </li>
                                  <li>
                                      #materialdesign
                                      <span class="pull-right">
                                          <i class="material-icons">trending_up</i>
                                      </span>
                                  </li>
                                  <li>#adminbsb</li>
                                  <li>#freeadmintemplate</li>
                                  <li>#bootstraptemplate</li>
                                  <li>
                                      #freehtmltemplate
                                      <span class="pull-right">
                                          <i class="material-icons">trending_up</i>
                                      </span>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <!-- #END# Latest Social Trends -->
                  <!-- Answered Tickets -->
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                      <div class="card">
                          <div class="body bg-teal">
                              <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                              <ul class="dashboard-stat-list">
                                  <li>
                                      TODAY
                                      <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                                  </li>
                                  <li>
                                      YESTERDAY
                                      <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                                  </li>
                                  <li>
                                      LAST WEEK
                                      <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                                  </li>
                                  <li>
                                      LAST MONTH
                                      <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                                  </li>
                                  <li>
                                      LAST YEAR
                                      <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                                  </li>
                                  <li>
                                      ALL
                                      <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <!-- #END# Answered Tickets -->
              </div>

              <div class="row clearfix">
                  <!-- Task Info -->
                  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <div class="card">
                          <div class="header">
                              <h2>TASK INFOS</h2>
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
                              <div class="table-responsive">
                                  <table class="table table-hover dashboard-task-infos">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Task</th>
                                              <th>Status</th>
                                              <th>Manager</th>
                                              <th>Progress</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>1</td>
                                              <td>Task A</td>
                                              <td><span class="label bg-green">Doing</span></td>
                                              <td>John Doe</td>
                                              <td>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                  </div>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>2</td>
                                              <td>Task B</td>
                                              <td><span class="label bg-blue">To Do</span></td>
                                              <td>John Doe</td>
                                              <td>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                                  </div>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>3</td>
                                              <td>Task C</td>
                                              <td><span class="label bg-light-blue">On Hold</span></td>
                                              <td>John Doe</td>
                                              <td>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
                                                  </div>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>4</td>
                                              <td>Task D</td>
                                              <td><span class="label bg-orange">Wait Approvel</span></td>
                                              <td>John Doe</td>
                                              <td>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                                  </div>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>5</td>
                                              <td>Task E</td>
                                              <td>
                                                  <span class="label bg-red">Suspended</span>
                                              </td>
                                              <td>John Doe</td>
                                              <td>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
                                                  </div>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- #END# Task Info -->
                  <!-- Browser Usage -->
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                      <div class="card">
                          <div class="header">
                              <h2>BROWSER USAGE</h2>
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
                              <div id="donut_chart" class="dashboard-donut-chart"></div>
                          </div>
                      </div>
                  </div>
                  <!-- #END# Browser Usage -->
              </div>
          </div>
      </section>



</body>
</html>
