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
    $ids = trim($_POST['idper']);
    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $tel = trim($_POST['tel']);
    $faction = trim($_POST['faction']);

          try
            {
            if($_POST['name'] != "")  {

                  $stmt = $db_con->prepare("UPDATE buapit_person
                    SET
                    person_name = '$name',
                    person_position = '$position',
                    person_tel = '$tel',
                    person_school_id = '$by',
                    person_faction = '$faction',
                    person_by = '$byuser'
                    WHERE person_id = '$ids' ");

                   if($stmt->execute())
                   {
                      //echo "1 สำเร็จ !";
                      header("Location: ../person");
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
