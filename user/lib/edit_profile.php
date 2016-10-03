<?php
    session_start();
    if(!isset($_SESSION['user_session']))
    {
     header("Location: ../../index.php");
    }

    require_once '../../config/db.php';

    $stmt = $db_con->prepare("UPDATE buapit_user SET user_last_update = NOW() WHERE user_id=:uname");
    $stmt->execute(array(":uname"=>$_SESSION['user_session']));

    $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_id=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['user_session']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  // รับค่าจากฟอร์ม
  $school = trim($_POST['school']);
  $school_id = trim($_POST['school-id']);
  $username = trim($_POST['username']);
  $newpass = trim($_POST['newpass']);
  $sl = "acGflxidpiblfirjosp";
  $newpass1 = $newpass.$sl;
  $user_hash_password = hash('sha256', $newpass1);
  $fullname  = trim($_POST['fullname']);
  $position  = trim($_POST['position']);
  $email  = trim($_POST['email']);
  $tel  = trim($_POST['tel']);

  //$create  = date("Y-m-d H:i:s");
  $modified  = date("Y-m-d H:i:s");

    try
      {
          if($newpass != "")  {
            $stmt = $db_con->prepare("UPDATE buapit_user
              SET
              user_school_id = '$school_id',
              user_school_name = '$school',
              user_name = '$username',
              user_password = '$user_hash_password',
              user_fullname = '$fullname',
              user_position = '$position',
              user_email = '$email',
              user_tel = '$tel',
              user_modified = NOW()
              WHERE user_id = '$id' ");

             if($stmt->execute())
             {
                //echo "1 สำเร็จ !";
                header("Location: ../index");
             }
             else
             {
              echo "2 เกิดข้อผิดพลาด !";
             }
          }
          else {
              $stmt = $db_con->prepare("UPDATE buapit_user
                SET
                user_school_id = '$school_id',
                user_school_name = '$school',
                user_name = '$username',
                user_fullname = '$fullname',
                user_position = '$position',
                user_email = '$email',
                user_tel = '$tel',
                user_modified = NOW()
                WHERE user_id = '$id' ");

               if($stmt->execute())
               {
                  //echo "2 สำเร็จ !";
                  header("Location: ../index");
               }
               else
               {
                echo "2 เกิดข้อผิดพลาด !";
               }
            }
      } // try

      catch(PDOException $e){
           echo $e->getMessage();
      } // cacth
}
else {
  echo "error";
  exit;
}

?>
