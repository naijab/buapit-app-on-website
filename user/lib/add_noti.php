<?php
    session_start();
    if(!isset($_SESSION['user_session']))
    {
     header("Location: ../index.php");
    }
    require_once '../../config/db.php';
    require_once '../../config/web_config.php';
    
    $stmt = $db_con->prepare("UPDATE buapit_user SET user_last_update = NOW() WHERE user_id=:uname");
    $stmt->execute(array(":uname"=>$_SESSION['user_session']));

    $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_id=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['user_session']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);



  function send_notification ($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			 'registration_ids' => $tokens,
			 'data' => $message
			);

		$headers = array(
			'Authorization:key = AIzaSyBN1kPWj_VJtHqi1PPFbWfjQUaNF1VfVkE',
			'Content-Type: application/json'
			);

	     $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
	}

  $conn = mysqli_connect("mysql.hostinger.in.th","u230592753_root","16.11.410","u230592753_xamxo");

  $sql = " Select Token From users";

	$result = mysqli_query($conn,$sql);
	$tokens = array();

	if(mysqli_num_rows($result) > 0 ){

		while ($row = mysqli_fetch_assoc($result)) {
			$tokens[] = $row["Token"];
		}
	}

  $mg = trim($_POST['mg']);
	$message = array("message" => $mg);
	$message_status = send_notification($tokens, $message);
	//echo $message_status;

        // รับค่าจากฟอร์ม
        //$message = trim($_POST['mg']);
        //$create  = date("Y-m-d H:i:s");
        //$modified  = date("Y-m-d H:i:s");
        $byuser  = $row['user_id'];

        try
          {
           if ($_POST['message']=!"") {
             $stmt = $db_con->prepare("INSERT INTO buapit_noti(noti_title,noti_create,noti_by) VALUES(:title, NOW(),:by)");
             $stmt->bindParam(":title",$mg);
             $stmt->bindParam(":by",$byuser);

             //ส่งค่ากลับไป
              if($stmt->execute())
              {
               echo "สำเร็จ !";
               // header("Location: ../notification");
              }
              else
              {
               echo "เกิดข้อผิดพลาด !";
              }
           }

          }
          catch(PDOException $e){
               echo $e->getMessage();
          }

?>
