<?php

require_once 'config/db.php';

if($_POST)
 {
   //กำหนดตัวแปรจากฟอร์มสมัครสมาชิก
  $user_name = trim($_POST['username']);
  $user_password = trim($_POST['password']);
  $user_fullname = trim($_POST['fullname']);
  $code = trim($_POST['code']);
  $school = trim($_POST['school']);
  $position = trim($_POST['position']);
  $email = trim($_POST['email']);
  $tel = trim($_POST['tel']);
  $user_level = "300";
  $user_last_update = "0000-00-00 00:00:00";
  $user_active = "0";
  $sl = "acGflxidpiblfirjosp";
  $newpass1 = $user_password.$sl;
  $user_hash_password = hash('sha256', $newpass1);
  //$user_hash_password = hash('sha256', $user_password);

try
  {
   //ตรวจสอบ username ซ้ำ
   $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_name=:user_name");
   $stmt->execute(array(":user_name"=>$user_name));
   $count = $stmt->rowCount();

   //ถ้าไม่สมัครสมาชิกได้
   if($count==0){

   $stmt = $db_con->prepare("INSERT INTO buapit_user(user_school_id,user_school_name,user_name,user_password,user_fullname, user_position, user_email, user_tel,user_create,user_modified,user_level,user_last_update,user_active) VALUES(:code,:scho,:uname,:upass, :ufullname,:uposi,:uemail,:utel, NOW(),NOW(),:ulevel, :ulast, :uactive)");
   $stmt->bindParam(":code",$code);
   $stmt->bindParam(":scho",$school);
   $stmt->bindParam(":uname",$user_name);
   $stmt->bindParam(":upass",$user_hash_password);
   $stmt->bindParam(":ufullname",$user_fullname);
   $stmt->bindParam(":uposi",$position);
   $stmt->bindParam(":uemail",$email);
   $stmt->bindParam(":utel",$tel);
   $stmt->bindParam(":ulevel",$user_level);
   $stmt->bindParam(":ulast",$user_last_update);
   $stmt->bindParam(":uactive",$user_active);


   //ส่งค่ากลับไป
    if($stmt->execute())
    {
      $stmt2 = $db_con->prepare("INSERT INTO buapit_data(school_id_code,school_name) VALUES(:codeds,:schos)");
      $stmt2->bindParam(":codeds",$code);
      $stmt2->bindParam(":schos",$school);
      $stmt2->execute();
     echo "registered";
     //header("Location: index.php");
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
