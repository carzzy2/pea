<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");


    $sql = "update tb_electricity set re_status='2' where re_id='" . $_POST[re_id] . "'";
    mysql_query($sql);
    $sql2 = "insert into tb_fee(fee_id,fee_date,re_id,user_id,fee_price) 
        values('" . $_POST[fee_id] . "',NOW(),'" . $_POST[re_id] . "','" . $_SESSION[loginid] . "','" . $_POST[fee_price] . "')";
    mysql_query($sql2);
    
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=fee_plate.php?fee_id=$_POST[fee_id]'> ";


?>