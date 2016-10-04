<?php

    require_once '../../config/db.php';
    require_once '../../config/web_config.php';

        $byuser  = "1039760327";
        $code = trim($_POST['permit_id_code']);
        $name = trim($_POST['permit_name']);
        $class = trim($_POST['permit_class']);
        $tel = trim($_POST['permit_tel']);
        $casue = trim($_POST['permit_casue']);
        $add = trim($_POST['permit_add']);
        $start = trim($_POST['permit_start']);
        $end = trim($_POST['permit_end']);
        $status = "รอผล";

        try
          {
           if ($_POST['title']=!"") {
             $stmt = $db_con->prepare("INSERT INTO buapit_permit(permit_id_code,permit_name,permit_add,permit_class,permit_tel,permit_casue,permit_add,permit_start,permit_end,permit_by,permit_status,permit_create) VALUES(:idcode, :name, :add, :class, :tel, :casue, :start, :endd, :by, :status, NOW())");
             $stmt->bindParam(":idcode",$code);
             $stmt->bindParam(":name",$name);
             $stmt->bindParam(":add",$add);
             $stmt->bindParam(":class",$class);
             $stmt->bindParam(":tel",$tel);
             $stmt->bindParam(":casue",$casue);
             $stmt->bindParam(":start",$start);
             $stmt->bindParam(":endd",$end);
             $stmt->bindParam(":by",$byuser);
             $stmt->bindParam(":status",$status);

             //ส่งค่ากลับไป
              if($stmt->execute())
              {
               echo "สำเร็จ !";
               //header("Location: ../calendar");
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
