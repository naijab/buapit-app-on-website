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
        $title = trim($_POST['title']);
        $url_1 = $_FILES['url'];
        //$url2 = trim($_POST['urlweb']);
        $content  = trim($_POST['content']);
        //$active  = trim($_POST['active']);
        //$create  = date("Y-m-d H:i:s");
        //$modified  = date("Y-m-d H:i:s");
        $by  = $row['user_school_id'];
        $byuser  = $row['user_id'];
        $root = getcwd().DIRECTORY_SEPARATOR;
        $path = "../../file/download/";
        $temp = explode(".", $_FILES["url"]["name"]);
        $english = "abcdefghijklmnopqrstuwvxyz";
        $newfilename = "dow-".rand(1,9999)."-".rand(1,999)."-".round(microtime(true)) . '.' . end($temp);
        $pathsave = $path.$newfilename;

        $urlfile = $web_url_file_download.$newfilename;

        try
          {
            if ($_FILES["url"] != "") {
              if (move_uploaded_file($_FILES["url"]["tmp_name"], $root.$pathsave)) {
                $stmt = $db_con->prepare("INSERT INTO buapit_download(download_title,download_desc,download_url,download_by,download_by_user) VALUES(:title, :content, :url, :by, :byuser)");
                $stmt->bindParam(":title",$title);
                $stmt->bindParam(":content",$content);
                $stmt->bindParam(":url",$urlfile);;
                $stmt->bindParam(":by",$by);
                $stmt->bindParam(":byuser",$byuser);

                //ส่งค่ากลับไป
                 if($stmt->execute())
                 {
                  //echo "1 สำเร็จ !";
                   header("Location: ../download");
                 }
                 else
                 {
                  echo "1 เกิดข้อผิดพลาด !";
                 }
              }
            }

          }//try
          catch(PDOException $e){
               echo $e->getMessage();
          }
?>
