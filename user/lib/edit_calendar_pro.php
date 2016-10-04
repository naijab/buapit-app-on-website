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

    $byuser  = $row['user_id'];
    $by  = $row['user_school_id'];
    $id  = trim($_POST['idcal']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $term = trim($_POST['term']);
    $start = trim($_POST['start']);
    $end = trim($_POST['end']);

          try
            {
            if($_POST['idcal'] != "")  {

                  $stmt = $db_con->prepare("UPDATE buapit_calendar
                    SET
                    calendar_title = '$title',
                    calendar_content = '$content',
                    calendar_date_start = '$start',
                    calendar_date_end = '$end',
                    calendar_term = '$term',
                    calendar_by = '$by',
                    calendar_by_user = '$byuser'
                    WHERE calendar_id = '$id' ");

                   if($stmt->execute())
                   {
                      //echo "1 สำเร็จ !";
                      header("Location: ../calendar");
                   }
                   else
                   {
                    echo "1 เกิดข้อผิดพลาด !";
                   }
                }else {
                    echo " 2 เกิดข้อผิดพลาด !";
                  }
            }// try


            catch(PDOException $e){
                 echo $e->getMessage();
            } // cacth
?>
