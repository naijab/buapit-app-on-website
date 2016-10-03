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

    $id = $_GET['did'];

    $stmt1 = $db_con->prepare("SELECT * FROM buapit_download WHERE download_by_user=:uid && download_id = '$id'");
    $stmt1->execute(array(":uid"=>$_SESSION['user_session']));
    $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    $url = $row1['download_url'];


          try
            {

            if(isset($_GET['did'])) {
                @unlink($url);
                $stmt = $db_con->prepare("DELETE FROM buapit_download WHERE download_id = '$id' ");

                  if($stmt->execute())
                  {
                   header("Location: ../download");
                  }else {echo " เกิดข้อผิดพลาด !";}
            }

            }// try
            catch(PDOException $e){
                 echo $e->getMessage();
            } // cacth
?>
