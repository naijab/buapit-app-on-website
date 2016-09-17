<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_dataname = "buapitapp";

// เชื่อมต่อฐานข้อมูล
try{
   $db_con = new PDO("mysql:host={$db_hostname};dbname={$db_dataname}",$db_username,$db_password);
   $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
   echo $e->getMessage();
}


?>
