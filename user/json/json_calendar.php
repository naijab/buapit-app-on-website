<?php

  require_once '../../config/db.php';
  $idcode = $_GET['id'];
  $idkey = $_GET['key'];
  if ($idkey === "avgfefAgfsdRdCidlVREWSfelfLKAqwporzcgo") {
    $stmt = $db_con->prepare("SELECT * FROM buapit_calendar WHERE calendar_by = '$idcode'" );
    $stmt->execute();
    $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $json=json_encode($results);
    echo $json;
  }else {
    echo "sorry access dehide";
  }


?>
