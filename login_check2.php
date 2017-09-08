<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
$username = $_POST[username];
$check_log = mysql_query("select * from tb_electricity where re_id ='$username' ");//ใช้ภาษา SQL ตรวจสอบข้อมูลในฐานข้อมูล
$num = mysql_num_rows($check_log);//ให้เอาค่าที่ได้ออกมาประกาศเป็นตัวแปรชื่อ $num
if($num <=0) {
    echo "<script>alert('รหัสใบคำร้องที่คุณป้อน ไม่มีอยู่ในระบบ!');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
} else {
        $data = mysql_fetch_array($check_log);
        $_SESSION[ses_userid] = session_id();           
        $_SESSION[loginid] = $data[re_id];
        echo "<meta http-equiv='refresh' content='0;URL=status_work_customer.php'>";
        
}
?>