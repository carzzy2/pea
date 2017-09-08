<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
$new_id = mysql_result(mysql_query("Select Max(substr(equ_id,-4))+1 as MaxID from tb_equipment"), 0, "MaxID");
if ($new_id == '') {
    $id = "130000000001";
} else {
    $id = "13" . sprintf("%010d", $new_id);
}
if ($_POST[typestatus] == "nopass") {
    $sql = "update tb_electricity set re_status='9' where re_id='" . $_POST[re_id] . "'";
    mysql_query($sql);
    $sql2 = "insert into tb_equipment(equ_id,equ_date,re_id,user_id,equ_detail,equ_status) 
        values('" . $id . "',NOW(),'" . $_POST[re_id] . "','" . $_POST[user_id] . "','" . $_POST[equ_detail] . "',1)";
    mysql_query($sql2);
    echo "<script>alert('บันทึกการสำรวงานใบคำร้องขอใช้ไฟฟ้าเลขที่ $_POST[re_id] เรียบร้อยแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=StatusElectricity.php'> ";
} else {
    $sql = "update tb_electricity set re_status='1' where re_id='" . $_POST[re_id] . "'";
    mysql_query($sql);
    if ($_POST[equ_other] == "") {
        $other = "-";
    } else {
        $other = $_POST[equ_other];
    }
    $sql2 = "insert into tb_equipment(equ_id,equ_date,re_id,user_id,equ_tran,equ_tran_unit,equ_air,equ_air_unit,equ_lantern,equ_outlet,equ_fan,equ_other,equ_status) 
        values('" . $id . "',NOW(),'" . $_POST[re_id] . "','" . $_POST[user_id] . "','" . $_POST[equ_tran] . "','" . $_POST[equ_tran_unit] . "','" . $_POST[equ_air] . "','" . $_POST[equ_air_unit] . "','" . $_POST[equ_lantern] . "','" . $_POST[equ_outlet] . "','" . $_POST[equ_fan] . "','" . $other . "',0)";
    mysql_query($sql2);
    echo "<script>alert('บันทึกการสำรวงานใบคำร้องขอใช้ไฟฟ้าเลขที่ $_POST[re_id] เรียบร้อยแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=StatusElectricity.php'>";
}
?>