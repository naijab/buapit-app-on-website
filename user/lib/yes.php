<?php
    session_start();
    if(!isset($_SESSION['user_session']))
    {
     header("Location: ../../index.php");
    }

    require_once '../../config/db.php';
    require_once '../../config/web_config.php';

    $stmt = $db_con->prepare("UPDATE buapit_user SET user_last_update = NOW() WHERE user_id=:uname");
    $stmt->execute(array(":uname"=>$_SESSION['user_session']));

    $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_id=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['user_session']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    // รับค่าจากฟอร์ม
    $id = trim($_GET['yid']);

    //$url2 = trim($_POST['urlweb']);
    //$content  = trim($_POST['content']);
    //$active  = trim($_POST['active']);
    //$create  = date("Y-m-d H:i:s");
    //$modified  = date("Y-m-d H:i:s");
    $by  = $row['user_school_id'];
    $byuser  = $row['user_id'];

    $status = "อนุญาต";
          try
            {
              $stmt1 = $db_con->prepare("UPDATE buapit_permit
                SET
                permit_status = '$status'
                WHERE permit_id = '$id' && permit_by = {$row['user_school_id']} ");
              if($stmt1->execute())
              {
               //echo "สำเร็จ 1";
               header("Location: ../permit");
              }else {echo " เกิดข้อผิดพลาด !";}

          } // try
            catch(PDOException $e){
                 echo $e->getMessage();
            } // cacth
?>
