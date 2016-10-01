<?php

include 'config/db.php';

if($_POST)
 {
   //กำหนดตัวแปรจากฟอร์มสมัครสมาชิก
  $user_name = $_POST['username'];
  $user_password = $_POST['password'];
  $user_fullname = $_POST['fullname'];
  $user_level = "300";
  $user_last_update = "0000-00-00 00:00:00";
  $user_active = "0";
  $user_hash_password = hash('sha256', $user_password);

try
  {
   //ตรวจสอบ username ซ้ำ
   $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_name=:user_name");
   $stmt->execute(array(":user_name"=>$user_name));
   $count = $stmt->rowCount();

   //ถ้าไม่สมัครสมาชิกได้
   if($count==0){

   $stmt = $db_con->prepare("INSERT INTO buapit_user(user_name,user_password,user_fullname,user_level,user_last_update,user_active) VALUES(:uname, :upass, :ufullname, :ulevel, :ulast, :uactive)");
   $stmt->bindParam(":uname",$user_name);
   $stmt->bindParam(":upass",$user_hash_password);
   $stmt->bindParam(":ufullname",$user_fullname);
   $stmt->bindParam(":ulevel",$user_level);
   $stmt->bindParam(":ulast",$user_last_update);
   $stmt->bindParam(":uactive",$user_active);

   //ส่งค่ากลับไป
    if($stmt->execute())
    {
     //echo "registered";
     header("Location: index.php");
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
