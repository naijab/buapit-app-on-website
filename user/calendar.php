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
<title><?= $web_title; ?> : จัดการปฏิทินกิจกรรม</title>
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
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  <?= $row['user_name']; ?><br>
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
                    <li  class="active">
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
                              <h2>จัดการปฏิทินกิจกรรม</h2>

                          </div>
                          <div class="body">
                            <button class="btn btn-success waves-effect waves-float" data-toggle="modal" data-target="#add_new_record_modal">เพิ่มรายการใหม่</button>
<div class="table-responsive">
<table class="table table-hover dashboard-task-infos">
<thead>
<tr>
 <th>#</th>
 <th>หัวข้อ</th>
 <th>เริ่มต้น</th>
 <th>สิ้นสุด</th>
 <th>ภาคการเรียน</th>
 <th>แก้ไข</th>
</tr>
</thead>
<tbody>
  <?php
        $stmt = $db_con->prepare("SELECT * FROM buapit_calendar WHERE calendar_by = {$row['user_id']} ORDER BY calendar_id DESC");
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $num=1;

        foreach ($row as $row) {

        ?>
            <tr>
            <td><?php echo $num++; ?></td>
            <td><?php echo $row['calendar_title']; ?></td>
            <td><?php echo $row['calendar_date_start']; ?></td>
            <td><?php echo $row['calendar_date_end']; ?></td>
            <td><?php echo $row['calendar_term']; ?></td>
            <td>
            <a id="edit-btn" class="btn btn-warning waves-effect waves-float" href="edit_calendar?eid=<?php echo $row['calendar_id']; ?>" >
            แก้ไข</a>
            <a id="<?php echo $row['news_id']; ?>" class="btn btn-danger waves-effect waves-float" href="javascript:delete_id(<?php echo $row['calendar_id']; ?>)">
            ลบ
                  </a></td>
            </tr>
          <?php } ?>
</tbody>
</table>
                                  <br><br>


                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- #END# Task Info -->

                  <!-- Bootstrap Modal - To Add New Record -->
                  <!-- Modal -->
                  <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-md" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">เพิ่มรายการใหม่</h4>
                  </div>
                  <div class="modal-body">
              <!--Add form-->
                <form action="lib/add_calendar" method="post" >
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="form-label">หัวข้อ</label>
                        <div class="form-line">
                            <input type='text' name='title' id='title' class='form-control' placeholder='ใส่หัวข้อ' required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">ภาคเรียน (เช่น ภาคเรียนที่ 1)</label>
                        <div class="form-line">
                            <input type='text' name='term' id='term' class='form-control' placeholder='ใส่ภาคเรียน' required />
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="form-group">
                      <label class="form-label">คำอธิบายสั้นๆ</label>
                      <div class="form-line">
                        <textarea type='text' id='content' name='content' class='form-control' placeholder='ใส่คำอธิบายสั้นๆ' rows="3" cols="20" style="overflow-y: scroll; resize: none;" required></textarea>
                    </div>
                  </div>
                <div class="row">
                  <div class="form-group">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">วันเริ่มต้น (เช่น จันทร์ 5 ก.พ.2559)</label>
                          <div class="form-line">
                              <input type='text' name='start' id='start' class='form-control' placeholder='ใส่วันเริ่มต้น' required />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">วันสิ้นสุด (เช่น อังคาร 6 ก.พ.2559)</label>
                          <div class="form-line">
                              <input type='text' name='end' id='end' class='form-control' placeholder='ใส่วันสิ้นสุด' required />
                          </div>
                        </div>
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
      </section>

      <script type="text/javascript">
        function delete_id(id)
            {
                if(confirm('ต้องการลบใช่หรือไม่ ?'))
                 {
                 window.location.href='lib/delete_calendar?did='+id;
                 }
            }
    </script>


</body>
</html>
