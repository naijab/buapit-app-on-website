<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_dataname = "buapitapp";
$web_url_image_news = "http://localhost/buapit/images/news/";
  // เชื่อมต่อฐานข้อมูล
  try{
     $db_con = new PDO("mysql:host={$db_hostname};dbname={$db_dataname}",$db_username,$db_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
     $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
     echo $e->getMessage();
  }

  //ออกจากระบบ user ที่ล็อกอินค้าง
  $intRejectTime = 1; // Minute
  $stmt = $db_con->prepare("UPDATE buapit_user SET user_active = '0', user_last_update = '0000-00-00 00:00:00' WHERE 1 AND DATE_ADD(LastUpdate, INTERVAL $intRejectTime MINUTE) <= NOW() ");


?>
