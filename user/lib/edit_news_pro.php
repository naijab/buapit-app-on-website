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

        $id = trim($_POST['id-news']);
        // รับค่าจากฟอร์ม
        $title = trim($_POST['title']);
        $image = trim($_FILES['image']);
        $oldimage = trim($_POST['id-img']);
        $content = trim($_POST['content']);
        $type  = trim($_POST['type']);
        $active  = trim($_POST['active']);
        //$create  = date("Y-m-d H:i:s");
        //$modified  = date("Y-m-d H:i:s");
        $by  = $row['user_school_id'];
        $byuser  = $row['user_name'];
        $root = getcwd().DIRECTORY_SEPARATOR;
        $path = "../../images/news/";
        $temp = explode(".", $_FILES["image"]["name"]);
        $english = "abcdefghijklmnopqrstuwvxyz";
        $newfilename = rand(1,999999)."-".rand(1,999999)."-".round(microtime(true)) . '.' . end($temp);
        $pathsave = $web_url_image_news.$newfilename;

          try
            {
            if($_FILES["image"]["name"] != "")  {
              if (move_uploaded_file($_FILES["image"]["tmp_name"], $root.$pathsave)) {

                  //*** ลบรูปเดิม  ***//
                  @unlink($root.$path.$oldimage);
                  $oldimage = "del-".$oldimage;

                  $stmt = $db_con->prepare("UPDATE buapit_news
                    SET
                    news_title = '$title',
                    news_img = '$newfilename',
                    news_content = '$content',
                    news_type = '$type',
                    news_active = '$active',
                    news_modified = NOW()
                    WHERE news_id = '$id' ");

                   if($stmt->execute())
                   {
                    //  echo "1 สำเร็จ !";
                      header("Location: ../news");
                   }
                   else
                   {
                    echo " เกิดข้อผิดพลาด !";
                   }
                }
            } else {
                $stmt = $db_con->prepare("UPDATE buapit_news
                  SET
                  news_title = '$title',
                  news_content = '$content',
                  news_type = '$type',
                  news_active = '$active',
                  news_modified = NOW()
                  WHERE news_id = '$id' ");

                 if($stmt->execute())
                 {
                    header("Location: ../news");
                 }
                 else
                 {
                  echo " เกิดข้อผิดพลาด !";
                 }
              }


          } // try
            catch(PDOException $e){
                 echo $e->getMessage();
            } // cacth
?>
