<?php

include 'config/db.php';

if($_POST)
 {
  $user_name = $_POST['user_name'];
  $user_password = $_POST['user_password'];
  $user_fullname = $_POST['user_fullname'];
  $user_level = "300";
  $user_last_update = "0000-00-00 00:00:00";
  $user_active = "0";

  try
  {

   $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_name=:user_name");
   $stmt->execute(array(":user_name"=>$user_name));
   $count = $stmt->rowCount();

   if($count==0){

   $stmt = $db_con->prepare("INSERT INTO buapit_user(user_name,user_password,user_fullname,user_level,user_last_update,user_active) VALUES(:uname, :upass, :ufullname, :ulevel, :ulast, :uactive)");
   $stmt->bindParam(":uname",$user_name);
   $stmt->bindParam(":upass",$user_password);
   $stmt->bindParam(":ufullname",$user_fullname);
   $stmt->bindParam(":ulevel",$user_level);
   $stmt->bindParam(":ulast",$user_last_update);
   $stmt->bindParam(":uactive",$user_active);

    if($stmt->execute())
    {
     echo "สมัครสมาชิกแล้ว";
    }
    else
    {
     echo "เกิดข้อผิดพลาด !";
    }

   }
   else{
    echo "1"; //  not available
   }

  }
  catch(PDOException $e){
       echo $e->getMessage();
  }
 }

?>
