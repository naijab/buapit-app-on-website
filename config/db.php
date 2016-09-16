<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_dataname = "buapitapp";

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($hostname, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{ echo  "สำเร็จ";}

try{
 $db_con = new PDO("mysql:host={$hostname};dbname={$dbname}",$db_username,$db_password);
 $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
      echo $e->getMessage();
}


?>
