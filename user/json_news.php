<?php

  require_once '../config/db.php';

  //$stmt = $db_con->prepare("SELECT * FROM buapit_news WHERE news_active = '1' && news_type = 'คุณครู' ");
  $stmt = $db_con->prepare("SELECT * FROM buapit_news WHERE news_active = '1'");
  $stmt->execute();
  $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
  $json=json_encode($results);
  echo $json;


?>
