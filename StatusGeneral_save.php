<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
if($_GET[mode]=="del"){
    $sql="update tb_general set rg_status='2' where rg_id='".$_GET[id]."'";
    mysql_query($sql);
    echo "<script>alert('ยกเลิกใบคำร้องทั่วไปเลขที่ $_GET[id] เรียบร้อยแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=StatusGeneral.php'> ";
}else{
    if($_POST[rg_want_type]>3){
        $sql="update tb_general set rg_status='1',rg_date_back=NOW() where rg_id='".$_POST[rg_id]."'";
        mysql_query($sql);
        echo "<script>alert('อนุมัติใบคำร้องทั่วไปเลขที่ $_POST[rg_id] เรียบร้อยแล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=StatusGeneral.php'> ";
    }else{
        $sql="update tb_general set rg_status='3' , rg_money='".$_POST[rg_money]."',rg_date_back=NOW()  where rg_id='".$_POST[rg_id]."'";
        mysql_query($sql);
        echo "<script>alert('อนุมัติใบคำร้องทั่วไปเลขที่ $_POST[rg_id] เรียบร้อยแล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=StatusGeneral_plate.php?id=$_POST[rg_id]'> ";
    }

}
?>