<?php

include 'config/db.php';

if($_POST)
  {
      $name = strip_tags($_POST['username']);

   $stmt=$db_con->prepare("SELECT user_name FROM buapit_user WHERE user_name=:name");
   $stmt->execute(array(':name'=>$name));
   $count=$stmt->rowCount();

   if($count>0)
   {
    echo "<span style='color:brown; padding-top:20px;'>ชื่อผู้ใช้ซ้ำ!!!</span>";
   }
   else
   {
    echo "<span style='color:green; padding-top:20px;'>ชื่อผู้ใช้สามารถใช้ได้</span>";
   }
 }
 ?>
