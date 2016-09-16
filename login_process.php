<?php
 session_start();
 require_once 'config/db.php';

 if(isset($_POST['btn-login']))
 {
  $user_name = trim($_POST['username']);
  $user_password = trim($_POST['password']);

  $password = hash('sha256', $user_password);

  try
  {

   $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_name=:uname");
   $stmt->execute(array(":uname"=>$user_name));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $count = $stmt->rowCount();

  // if ($row['user_active']=="0") {
     if($row['user_password']==$password){
      echo "ok"; // log in
    /*  $stmt = $db_con->prepare("UPDATE buapit_user SET user_active = '1', user_last_update = NOW() WHERE user_name=:uname");
      $stmt->execute(array(":uname"=>$user_name));*/
      $_SESSION['user_session'] = $row['user_id'];
     }
     else{
      echo "ชื่อหรือรหัสผ่านผิด"; // wrong details
     }
  // }
//   else {
//   }

  }
  catch(PDOException $e){
   echo $e->getMessage();
  }
 }
 ?>
