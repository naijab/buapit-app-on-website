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
        $name = trim($_POST['name']);
        $position = trim($_POST['position']);
        $tel = trim($_POST['tel']);
        $faction = trim($_POST['faction']);

        try
          {
           if ($_POST['name']=!"") {
             $stmt = $db_con->prepare("INSERT INTO buapit_person(person_name,person_position,person_tel,person_school_id,person_faction,person_by) VALUES(:name, :posi, :tel, :scid, :fac,:by)");
             $stmt->bindParam(":name",$name);
             $stmt->bindParam(":posi",$position);
             $stmt->bindParam(":tel",$tel);
             $stmt->bindParam(":scid",$by);
             $stmt->bindParam(":fac",$faction);
             $stmt->bindParam(":by",$byuser);

             //ส่งค่ากลับไป
              if($stmt->execute())
              {
               //echo "สำเร็จ !";
               header("Location: ../person");
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
