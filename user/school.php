<?php
session_start();

if(!isset($_SESSION['user_session']))
{
 header("Location: ../index.php");
}

require_once '../config/db.php';

  $stmt = $db_con->prepare("UPDATE buapit_user SET user_last_update = NOW() WHERE user_id=:uname");
  $stmt->execute(array(":uname"=>$_SESSION['user_session']));

  $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_id=:uid");
  $stmt->execute(array(":uid"=>$_SESSION['user_session']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);

  $stmts = $db_con->prepare("SELECT * FROM buapit_data WHERE school_id_code=:pid");
  $stmts->execute(array(":pid"=>$row['user_school_id']));
  $rows=$stmts->fetch(PDO::FETCH_ASSOC);

?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php require_once '../config/web_config.php';?>
<title><?= $web_title; ?> : จัดการข้อมูลโรงเรียน</title>
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
                      <?= $row['user_email']?>
                  </div>
              </div>
          </div>
          <!-- #User Info -->
          <div class="menu">
              <ul class="list">
                  <li class="header">เมนูหลัก</li>
                  <li>
                      <a href="index">
                          <i class="material-icons">home</i>
                          <span>หน้าแรก</span>
                      </a>
                  </li>
                  <li class="active">
                     <a href="javascript:void(0);" class="menu-toggle">
                         <i class="material-icons">recent_actors</i>
                         <span>จัดการข้อมูลโรงเรียน</span>
                     </a>
                     <ul class="ml-menu">
                         <li class="active">
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

              <div class="row clearfix">
                  <!-- Content Main -->
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table_content">
                      <div class="card">
                          <div class="header bg-orange">
                              <h2>จัดการข้อมูลโรงเรียน
                              </h2>
                          </div>
                          <div class="body">
                            <!--edit school form-->
                            <form id="edit_form" action="lib/school_pro" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <input type="hidden" value="<?php echo $row['user_school_id'];?>" name="id-school" />
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="form-label">ชื่อโรงเรียน</label>
                                            <div class="form-line">
                                                <input type='text' name='school' id='school' class='form-control' placeholder='ใส่ชื่อโรงเรียน เช่น โรงเรียนหนองบัวพิทยาคาร' value="<?php echo $rows['school_name'];?>" required /> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">รหัสโรงเรียน</label>
                                            <div class="form-line">
                                                <input type='text' name='school-id' id='school-id' class='form-control' placeholder='ใส่รหัสโรงเรียน 10 หลัก' value="<?php echo $rows['school_id_code'];?>" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">ประวัติโรงเรียน</label>
                                        <div class="form-line">
                                <textarea type='text' id='history' name='history' class='form-control' placeholder='ใส่ประวัติโรงเรียน' rows="10" cols="10" style="overflow-y: scroll; resize: none; text-align:left;" required><?php echo trim($rows['school_history']);?></textarea>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">ที่อยู่โรงเรียน</label>
                                        <div class="form-line">
                                <textarea type='text' id='address' name='address' class='form-control' placeholder='ใส่เนื้อเรื่อง' rows="5" cols="5" style="overflow-y: scroll; resize: none; text-align:left;" required><?php  echo trim($rows['school_address']);?></textarea>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                        <label class="form-label">เบอร์โทรศัพท์</label>
                                          <div class="form-line">
                                              <input type='text' name='tel' id='tel' class='form-control' placeholder='ใส่เบอร์โทรศัพท์' value="<?php echo $rows['school_tel'];?>" required />
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="form-label">เบอร์โทรสาร</label>
                                          <div class="form-line">
                                              <input type='text' name='tel2' id='tel2' class='form-control' placeholder='ใส่เบอร์โทรสาร หากไม่มีใส่ -' value="<?php echo $rows['school_tel2'];?>" required />
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                        <label class="form-label">สังกัด (เช่น สพม.เขต 19)</label>
                                          <div class="form-line">
                                              <input type='text' name='under' id='under' class='form-control' placeholder='ใส่สังกัดสถานศึกษา' value="<?php echo $rows['school_under'];?>" required />
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="form-label">เว็บไซต์ (ใส่ http:// นำหน้า)</label>
                                          <div class="form-line">
                                              <input type='text' name='website' id='website' class='form-control' placeholder='ใส่เว็บไซต์ หากไม่มีใส่ -' value="<?php echo $rows['school_website'];?>" required />
                                          </div>
                                      </div>
                                  </div>
                              </div>
                                <div class="row">

                                    <div class="form-group">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label class="form-label">ผู้อำนวยการสถานศึกษา</label>
                                              <div class="form-line">
                                                  <input type='text' name='direct' id='direct' class='form-control' placeholder='ใส่ชื่อผู้อำนวยการสถานศึกษา' value="<?php echo $rows['school_direct'];?>" required />
                                              </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="form-label">ระดับที่เปิดสอน (เช่น ม.ต้น-ม.ปลาย)</label>
                                              <div class="form-line">
                                                  <input type='text' name='subject' id='subject' class='form-control' placeholder='ใส่ระดับที่เปิดสอน' value="<?php echo $rows['school_subject'];?>" required />
                                              </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <img width="100px" src="<?php echo $rows['school_logo'];?>">
                                              <label class="form-label">ตราประจำโรงเรียน</label>
                                              <div class="form-line">
                                                  <input type="file" id='image' name='image' class='form-control' placeholder='' /> </div>
                                        </div>
                                    </div>
                                  </div>
                                    <div class="row">
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label class="form-label">จำนวนนักเรียนรวม (เช่น 100 คน)</label>
                                            <div class="form-line">
                                                <input type='text' name='total' id='total' class='form-control' placeholder='ใส่จำนวนนักเรียนรวม' value="<?php echo $rows['school_total'];?>" required />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label class="form-label">จำนวนคุณครูรวม (เช่น 100 คน)</label>
                                            <div class="form-line">
                                                <input type='text' name='total1' id='total1' class='form-control' placeholder='ใส่จำนวนคุณครูรวม' value="<?php echo $rows['school_total1'];?>" required />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label class="form-label">พิกัด GPS (ละติดจูด,ลองติจูด)</label>
                                            <div class="form-line">
                                                <input type='text' name='gps' id='gps' class='form-control' placeholder='ใสพิกัด GPS' value="<?php echo $rows['school_gps'];?>" required />
                                            </div>
                                        </div>
                                        <div class="pull-right"><button type="button" class="btn btn-danger btn-lg ">ยกเลิก</button>&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-lg ">บันทึก</button></div>

                                      </div>


                                    </div>
                                    </form>
                                </div>
                            </div>



                            </div>
                            </div>
                            </div>
                            <!-- #END# Task Info -->

              </div>
          </div>

</body>
</html>
