<?php
    session_start();
    if(!isset($_SESSION['user_session']))
    {
     header("Location: ../index.php");
    }
    require_once '../../config/db.php';
    require_once '../../config/web_config.php';

    $stmt = $db_con->prepare("UPDATE buapit_user SET user_last_update = NOW() WHERE user_id=:uname");
    $stmt->execute(array(":uname"=>$_SESSION['user_session']));

    $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_id=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['user_session']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

        $byuser  = $row['user_id'];
        $by  = $row['user_school_id'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $term = trim($_POST['term']);
        $start = trim($_POST['start']);
        $end = trim($_POST['end']);

        try
          {
           if ($_POST['title']=!"") {
             $stmt = $db_con->prepare("INSERT INTO buapit_calendar(calendar_title,calendar_content,calendar_date_start,calendar_date_end,calendar_term,calendar_by,calendar_by_user) VALUES(:title, :con, :startday, :endday, :term,:by,:byu)");
             $stmt->bindParam(":title",$title);
             $stmt->bindParam(":con",$content);
             $stmt->bindParam(":startday",$start);
             $stmt->bindParam(":endday",$end);
             $stmt->bindParam(":term",$term);
             $stmt->bindParam(":by",$by);
             $stmt->bindParam(":byu",$byuser);

             //ส่งค่ากลับไป
              if($stmt->execute())
              {
               //echo "สำเร็จ !";
               header("Location: ../calendar");
              }
              else
              {
               echo "เกิดข้อผิดพลาด !";
              }
           }

          }
          catch(PDOException $e){
               echo $e->getMessage();
          }

?>
