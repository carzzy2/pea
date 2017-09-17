<meta charset="utf-8">
<?php
	@session_start();
	include "connect_db.php";
	mysql_query("SET NAMES UTF8");
        $new_id = mysql_result(mysql_query("Select Max(substr(work_id,-4))+1 as MaxID from tb_work"), 0, "MaxID");
        if ($new_id == '') {
            $new = "150000000001";
        } else {
            $new = "15" . sprintf("%010d", $new_id);
        }
        $sqlup = "update tb_electricity set re_status='3' where re_id='" . $_SESSION['ss_re_id'] . "'";
        mysql_query($sqlup);
	$sql="insert into tb_work(work_id,work_date,re_id) values('".$new."',NOW(),'".$_SESSION['ss_re_id']."')";
        if(mysql_query($sql)){
            for($i=0;$i<count($_SESSION['ss_user_id']);$i++){

                $sql_detail="insert into tb_work_detail(work_id,user_id,work_detail)
                        values('".$new."','".$_SESSION['ss_user_id'][$i]."','".$_SESSION['ss_user_detail'][$i]."')";
                mysql_query($sql_detail);
            }
            session_unregister("ss_re_id");
            session_unregister("ss_user_id");
            session_unregister("ss_user_detail");
            echo "<script>alert('เรียบร้อย');</script>";
            echo "<META http-equiv='refresh' Content='0; URL=work_show.php'> ";
        }else{
            echo "<script>alert('เกิดการผิดพลาดระหว่างการบันทึกข้อมูล');</script>";
            echo "<meta http-equiv='refresh' content='0;URL=work_new.php' />";
        }
?>