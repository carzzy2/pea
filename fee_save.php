<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");

if($_POST[send_type]=="reid"){
    $sql = "update tb_electricity set re_status='2' where re_id='" . $_POST[re_id] . "'";
    mysql_query($sql);
    $sql2 = "insert into tb_fee(fee_id,fee_date,re_id,user_id,fee_price) 
        values('" . $_POST[fee_id] . "',NOW(),'" . $_POST[re_id] . "','" . $_SESSION[loginid] . "','" . $_POST[fee_price] . "')";
    mysql_query($sql2);
    
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=fee_plate.php?fee_id=$_POST[fee_id]'> ";

}elseif($_POST[send_type]=="rgid"){
    $fee=($_POST[fee_price] * 7 )/100;
    $fee2=$fee + $_POST[fee_price];
    $sql = "update tb_general set rg_status='3' where rg_id='" . $_POST[rg_id] . "'";
    mysql_query($sql);
    $sql2 = "insert into tb_fee(fee_id,fee_date,rg_id,user_id,fee_price) 
        values('" . $_POST[fee_id] . "',NOW(),'" . $_POST[rg_id] . "','" . $_SESSION[loginid] . "','" .$fee2 . "')";
    mysql_query($sql2);
    
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=fee_plate.php?fee_id=$_POST[fee_id]'> ";
}
?>