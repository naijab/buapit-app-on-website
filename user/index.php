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
  $row_news = $stmt_news->fetch(PDO::FETCH_ASSOC);
  $row_cout_news = $stmt_news->rowCount();

?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php require_once '../config/web_config.php';?>
<title><?= $web_title; ?> : หน้าแรก</title>
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
                  <a class="navbar-brand" href="index"><b><?= $web_title ?></b></a>
              </div>
              <div class="collapse navbar-collapse" id="navbar-collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>-->
                    <!-- #END# Call Search -->
                    <li><a href="index">สวัสดี <?= $row['user_name']?></a></li>
                    <li><a href="../logout">ออกจากระบบ</a></li>
                  </ul>
              </div>
          </div>
      </nav>
      <!-- #Top Bar -->
      <section>
          <!-- Left Sidebar -->
          <aside id="leftsidebar" class="sidebar">
              <!-- User Info -->
              <div class="user-info" style="max-height:100px;">
                  <div class="image">

                  </div>
                  <div class="info-container">
                      <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $row['user_name']; ?><br>
                      <?= $row['user_email']?></div>
                  </div>
              </div>
              <!-- #User Info -->
              <!-- Menu -->
              <div class="menu">
                  <ul class="list">
                      <li class="header">เมนูหลัก</li>
                      <li class="active">
                          <a href="index">
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
                                 <a href="school">จัดการข้อมูลโรงเรียน</a>
                             </li>
                             <li>
                                 <a href="person">จัดการบุคลากร</a>
                             </li>
                         </ul>
                     </li>
                      <li>
                          <a href="notification">
                              <i class="material-icons">speaker_phone</i>
                              <span>จัดการข้อความแจ้งเตือน</span>
                          </a>
                      </li>
                      <li>
                          <a href="news">
                              <i class="material-icons">chat</i>
                              <span>จัดการข่าวสารประชาสัมพันธ์</span>
                          </a>
                      </li>
                      <li>
                          <a href="permit">
                              <i class="material-icons">transfer_within_a_station</i>
                              <span>จัดการใบอนุญาตออกนอกโรงเรียน</span>
                          </a>
                      </li>
                      <li>
                          <a href="calendar">
                              <i class="material-icons">today</i>
                              <span>จัดการปฏิทินกิจกรรม</span>
                          </a>
                      </li>
                      <li>
                          <a href="download">
                              <i class="material-icons">get_app</i>
                              <span>จัดการไฟล์ดาวน์โหลด</span>
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
                              <div class="number count-to" data-from="0" data-to="<?= $row_cout_news; ?>" data-speed="15" data-fresh-interval="20"></div>
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
                             <div class="number count-to" data-from="0" data-to="<?= $row_cout_news; ?>" data-speed="15" data-fresh-interval="20"></div>
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
                             <div class="number count-to" data-from="0" data-to="<?= $row_cout_news; ?>" data-speed="15" data-fresh-interval="20"></div>
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
                             <div class="number count-to" data-from="0" data-to="<?= $row_cout_news; ?>" data-speed="15" data-fresh-interval="20"></div>
                          </div>
                      </div>
                  </div>

              </div>
              <!-- #END# Widgets -->
              <div class="row clearfix">

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
                              <h2>ข้อมูลส่วนตัว</h2>
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
                          <div class="body" >

                            <div class="row" style="padding:10px;">
                              <div class="form-group"><h4>
                                  <p id="pr-user" class="form-control-static">ชื่อผู้ใช้งาน:
                                    <b class="<?= $web_color?>"> <?= $row['user_name']?></b></p>
                                  <p id="pr-user" class="form-control-static"><b>ระดับ: </b>
                                    <b class="<?= $web_color?>"><?php
                                  if ($row['user_level']==300) {
                                    echo "ผู้ดูแลระบบ (Admin)";
                                  }
                                  if ($row['user_level']==700) {
                                    echo "ผู้จัดการระบบ (Super Admin)";
                                  }
                                  ?></b></p> </h4>
                              </div>
                              <button class="pull-right btn btn-success waves-effect waves-float" data-toggle="modal" data-target="#edit-profile">แก้ไขข้อมูลส่วนตัว</button>
                            </div>


                            <!-- Bootstrap Modal - To Add New Record -->
                            <!-- Modal -->
                            <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลส่วนตัว</h4>
                            </div>
                            <div class="modal-body">
                              <form id="edit_form" action="lib/edit_profile?id=<?php echo $row['user_id'] ?>" method="post">
                                  <div class="row" style="padding:10px;">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-label">โรงเรียน</label>
                                          <div class="form-line">
                                              <input type="text" name="school" id="school" class="form-control" placeholder="" value="<?php echo $row['user_school_name'];?>" required /> </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="form-label">รหัสโรงเรียน</label>
                                          <div class="form-line">
                                              <input type="text" name="school-id" id="school-id" class="form-control" placeholder="" value="<?php echo $row['user_school_id'];?>" required /> </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="form-label">ชื่อผู้ใช้งาน username</label>
                                          <div class="form-line">
                                              <input type="text" name="username" id="username" class="form-control" placeholder="" value="<?php echo $row['user_name'];?>" required /> </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="form-label">รหัสผ่าน password ใหม่</label>
                                          <div class="form-line">
                                              <input type="password" name="newpass" id="newpass" class="form-control" placeholder="" value="" /> </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="form-label">วันที่สมัครสมาชิก</label>
                                          <div class="form-line">
                                            <p class="form-control-static">
                                              <?php echo $row['user_create'];?>
                                            </p>
                                          </div>
                                      </div>

                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">ชื่อ - สกุล</label>
                                        <div class="form-line">
                                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="" value="<?php echo $row['user_fullname'];?>" required /> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">ตำแหน่ง</label>
                                        <div class="form-line">
                                            <input type="text" name="position" id="position" class="form-control" placeholder="" value="<?php echo $row['user_position'];?>" required /> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">อีเมลล์</label>
                                        <div class="form-line">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="" value="<?php echo $row['user_email'];?>" required /> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">เบอร์โทรศัพท์</label>
                                        <div class="form-line">
                                            <input type="text" name="tel" id="tel" class="form-control" placeholder="" value="<?php echo $row['user_tel'];?>" required /> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">ระดับผู้ใช้งาน</label>
                                        <div class="form-line">
                                          <p class="form-control-static">
                                            <?php
                                              if ($row['user_level']==300) {
                                                echo "ผู้ดูแลระบบ (Admin)";
                                              }
                                              if ($row['user_level']==700) {
                                                echo "ผู้จัดการระบบ (Super Admin)";
                                              }
                                            ?>
                                          </p>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">ยกเลิก</button>
                              <button type="submit" onclick="return edit_user_form();" class="btn btn-primary btn-lg">บันทึก</button>
                            </form>
                            </div>
                          </div>
                          </div>
                        </div>
                        <!-- End Modal Add -->


                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- #END# Browser Usage -->
              </div>
          </div>
      </section>



</body>
</html>
