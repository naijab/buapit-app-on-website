<?php
    session_start();
    if(!isset($_SESSION['user_session']))
    {
     header("Location: ../../index.php");
    }

    require_once '../../config/db.php';
    require_once '../../config/web_config.php';

    $stmt = $db_con->prepare("UPDATE buapit_user SET user_last_update = NOW() WHERE user_id=:uname");
    $stmt->execute(array(":uname"=>$_SESSION['user_session']));

    $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_id=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['user_session']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

        // รับค่าจากฟอร์ม
        $idname = trim($_POST['school-id']);
        $schoolname = trim($_POST['school']);
        $history = trim($_POST['history']);
        $address = trim($_POST['address']);
        $tel = trim($_POST['tel']);
        $tel2 = trim($_POST['tel2']);
        $under = trim($_POST['under']);
        $website = trim($_POST['website']);
        $direct = trim($_POST['direct']);
        $subject = trim($_POST['subject']);
        $total = trim($_POST['total']);
        $total1 = trim($_POST['total1']);
        $gps = trim($_POST['gps']);
        $image = trim($_FILES['image']);
        //$oldimage = $_POST['id-img'];

        $by  = $row['user_school_id'];

        $root = getcwd().DIRECTORY_SEPARATOR;
        $path = "../../images/school/";
        $temp = explode(".", $_FILES["image"]["name"]);
        //$english = "abcdefghijklmnopqrstuwvxyz";
        $newfilename = rand(1,999999)."-".rand(1,999999)."-".round(microtime(true)) . '.' . end($temp);
        $pathsave = $path.$newfilename;
        $rootimg_save = $web_url_image_school.$newfilename;
          try
            {

            if($_FILES["image"]["name"] != "")  {
              if (move_uploaded_file($_FILES["image"]["tmp_name"], $root.$pathsave)) {

                  //*** ลบรูปเดิม  ***//
                  @unlink($root.$path.$oldimage);

                    $stmt = $db_con->prepare("UPDATE buapit_data
                    SET
                    school_id_code = '$idname',
                    school_name = '$schoolname',
                    school_history = '$history',
                    school_address  = '$address',
                    school_tel = '$tel',
                    school_tel2 = '$tel2',
                    school_under = '$under',
                    school_website = '$website',
                    school_direct = '$direct',
                    school_subject = '$subject',
                    school_total = '$total',
                    school_total1 = '$total1',
                    school_gps = '$gps',
                    school_logo = '$rootimg_save'
                    WHERE school_id_code = '$by' ");

                   if($stmt->execute())
                   {
                    //echo "1 สำเร็จ !";
                    header("Location: ../school");
                   }
                   else
                   {
                    echo "1 เกิดข้อผิดพลาด !";
                   }
                }
            } else {
              $stmt = $db_con->prepare("UPDATE buapit_data
                  SET
                  school_id_code = '$idname',
                  school_name = '$schoolname',
                  school_history = '$history',
                  school_address  = '$address',
                  school_tel = '$tel',
                  school_tel2 = '$tel2',
                  school_under = '$under',
                  school_website = '$website',
                  school_direct = '$direct',
                  school_subject = '$subject',
                  school_total = '$total',
                  school_total1 = '$total1',
                  school_gps = '$gps'
                  WHERE school_id_code = '$by' ");

                 if($stmt->execute())
                 {  //echo "2 สำเร็จ !";
                    header("Location: ../school");
                 }
                 else
                 {
                  echo "2 เกิดข้อผิดพลาด !";
                 }
              }


          } // try
            catch(PDOException $e){
                 echo $e->getMessage();
            } // cacth
?>
