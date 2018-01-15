<?php

  require_once '../../config/db.php';
  $idcode = $_GET['id'];
  $idkey = $_GET['key'];
  //$stmt = $db_con->prepare("SELECT * FROM buapit_news WHERE news_active = '1' && news_type = 'คุณครู' ");
  if ($idkey === "avgfefAgfsdRdCidlVREWSfelfLKAqwporzcgo") {
    $stmt = $db_con->prepare("SELECT * FROM buapit_news WHERE news_active = '1' && news_by = '$idcode' ");
    $stmt->execute();
    $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $json=json_encode($results);
    echo $json;
  }else {
  echo "sorry access dehide";
  }


?>
