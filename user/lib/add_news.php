<?php
    session_start();
    if(!isset($_SESSION['user_session']))
    {
     header("Location: ../index.php");
    }

    include_once '../../config/db.php';

    $stmt = $db_con->prepare("UPDATE buapit_user SET user_last_update = NOW() WHERE user_id=:uname");
    $stmt->execute(array(":uname"=>$_SESSION['user_session']));

    $stmt = $db_con->prepare("SELECT * FROM buapit_user WHERE user_id=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['user_session']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['title']) && isset($_POST['type']) && isset($_POST['content']) && isset($_FILES['image']) )
    {

        // รับค่าจากฟอร์ม
        $title = $_POST['title'];
        $image = $_FILES['image'];
        $content = $_POST['content'];
        $type  = $_POST['type'];
        $active  = $_POST['active'];
        //$create  = date("Y-m-d H:i:s");
        //$modified  = date("Y-m-d H:i:s");
        $by  = $row['user_school_id'];
        $byuser  = $row['user_name'];
        $root = getcwd().DIRECTORY_SEPARATOR;
        $path = "../../images/news/";
        $temp = explode(".", $_FILES["image"]["name"]);
        $english = "abcdefghijklmnopqrstuwvxyz";
        $newfilename = rand(1,999999)."-".rand(1,999999)."-".round(microtime(true)) . '.' . end($temp);
        $pathsave = $path.$newfilename;

        try
          {
           if (move_uploaded_file($_FILES["image"]["tmp_name"], $root.$pathsave)) {
             $stmt = $db_con->prepare("INSERT INTO buapit_news(news_title,news_img,news_content,news_type,news_active,news_create,news_modified,news_by,news_by_user) VALUES(:title, :image, :content, :type, :active, NOW(), NOW(),:by,:byuser)");
             $stmt->bindParam(":title",$title);
             $stmt->bindParam(":image",$newfilename);
             $stmt->bindParam(":content",$content);
             $stmt->bindParam(":type",$type);
             $stmt->bindParam(":active",$active);
             //$stmt->bindParam(":create",$create);
             //$stmt->bindParam(":modified",$modified);
             $stmt->bindParam(":by",$by);
             $stmt->bindParam(":byuser",$byuser);

             //ส่งค่ากลับไป
              if($stmt->execute())
              {
               echo "เพิ่มข่าวสำเร็จ";
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
    }
?>
