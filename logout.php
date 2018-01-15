<?php
   session_start();
   require_once 'config/db.php';
   $user_ses = $_SESSION['user_session'];
   $stmt = $db_con->prepare("UPDATE buapit_user SET user_active = '0', user_last_update = '0000-00-00 00:00:00' WHERE user_id=:uid");
   $stmt->execute(array(":uid"=>$user_ses));
   unset($_SESSION['user_session']);
   unset($_SESSION['user_level']);
   if(session_destroy())
   {
    header("Location: index");
   }
?>