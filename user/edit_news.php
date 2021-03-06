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
?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php require_once '../config/web_config.php';?>
        <title><?= $web_title; ?> : จัดการข่าวสารประชาสัมพันธ์ > แก้ไข</title>
      </head>

    <body class="<?= $web_theme; ?>" style="<?= $web_font; ?>">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="md-preloader pl-size-md">
                    <svg viewbox="0 0 75 75">
                        <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" /> </svg>
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
            <div class="search-icon"> <i class="material-icons">search</i> </div>
            <input type="text" placeholder="START TYPING...">
            <div class="close-search"> <i class="material-icons">close</i> </div>
        </div>
        <!-- #END# Search Bar -->
        <!-- Top Bar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
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
                      <li>
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
                      <li  class="active">
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
                <?php
                $eid = $_GET['eid'];
                $stmt = $db_con->prepare("SELECT * FROM buapit_news WHERE news_id=:eid");
                $stmt->execute(array(":eid"=>$eid));
                $row=$stmt->fetch(PDO::FETCH_ASSOC);

               ?>
                    <div class="row clearfix">
                        <!-- Content Main -->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table_content">
                            <div class="card">
                                <div class="header bg-orange">
                                    <h2>จัดการข่าวสารประชาสัมพันธ์ > แก้ไข
                              </h2>

                                </div>
                                <div class="body">
                                    <!--Add form-->
                                    <form id="edit_form" action="lib/edit_news_pro?id=<?php echo $eid ?>" enctype="multipart/form-data" method="post">
                                        <div class="row">
                                            <input type="hidden" value="<?php echo $row['news_id'];?>" name="id-news" />
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="form-label">ชื่อเรื่อง</label>
                                                    <div class="form-line">
                                                        <input type='text' name='title' id='title' class='form-control' placeholder='ใส่ชื่อเรื่อง' value="<?php echo $row['news_title'];?>" required /> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
<label class="form-label">เลือกประเภท</label>
<select class="form-control" name="type" id="type" required>

<option value="ทั่วไป" <?php if($row['news_type']=="ทั่วไป"){echo 'selected="selected"';} ?>>ทั่วไป</option>
<option value="นักเรียน" <?php if($row['news_type']=="นักเรียน"){echo 'selected="selected"';} ?>>นักเรียน</option>
<option value="คุณครู" <?php if($row['news_type']=="คุณครู"){echo 'selected="selected"';} ?>>คุณครู</option>
<option value="วิชาการ" <?php if($row['news_type']=="วิชาการ"){echo 'selected="selected"';} ?>>วิชาการ</option>
<option value="รางวัลและการแข่งขัน" <?php if($row['news_type']=="รางวัลและการแข่งขัน"){echo 'selected="selected"';} ?>>รางวัลและการแข่งขัน</option>
<option value="การเงิน / ธุรการ" <?php if($row['news_type']=="การเงิน / ธุรการ"){echo 'selected="selected"';} ?>>การเงิน / ธุรการ</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">เนื้อข่าว</label>
                                            <div class="form-line">
    <textarea type='text' id='content' name='content' class='form-control' placeholder='ใส่เนื้อเรื่อง' rows="10" cols="20" style="overflow-y: scroll; resize: none; text-align:left;" required><?php echo trim($row['news_content']);?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" value="<?php echo $row['news_img'];?>" name="id-img" />
                                            <div class="form-group">
                                                <div class="col-md-9"> <img width="100px" src="<?php echo $row['news_img'];?>">
                                                    <label class="form-label">รูปภาพ</label>
                                                    <div class="form-line">
                                                        <input type="file" id='image' name='image' class='form-control' placeholder='' /> </div>
                                                </div>
                                    <div class="col-md-3">
    <input name="active" id="active1" type="radio" class="rad-active with-gap radio-col-green" <?php if ($row[ 'news_active']==1) {echo 'checked="checked"';} ?> value="1" >
    <label for="active1">เผยแพร่</label>
    <input name="active" id="active2" type="radio" class="rad-active with-gap radio-col-red" <?php if ($row[ 'news_active']==0) {echo 'checked="checked"';} ?> value="0" >
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
                    <!-- #END# Task Info -->
            </div>
            </div>
        </section>

  </body>
  </html>
