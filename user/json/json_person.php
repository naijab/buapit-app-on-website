<?php

  require_once '../../config/db.php';
  $idcode = $_GET['id'];
  $idkey = $_GET['key'];
  if ($idkey === "avgfefAgfsdRdCidlVREWSfelfLKAqwporzcgo") {
    $stmt = $db_con->prepare("SELECT * FROM buapit_person WHERE person_school_id = '$idcode'" );
    $stmt->execute();
    $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $json=json_encode($results);
    echo $json;
  }else {
    echo "sorry access dehide";
  }


?>
