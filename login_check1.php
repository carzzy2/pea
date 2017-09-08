
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
$username = $_POST[username];//ประกาศซตัวแปรชื่อ username โดยการรับค่ามาจากกล่อง username ที่หน้า Login
$password = $_POST[password];//ประกาศซตัวแปรชื่อ password โดยการรับค่ามาจากกล่อง password ที่หน้า Login
$check_log = mysql_query("select * from tb_user where user_id ='$username' and user_pass ='$password' ");//ใช้ภาษา SQL ตรวจสอบข้อมูลในฐานข้อมูล
$num = mysql_num_rows($check_log);//ให้เอาค่าที่ได้ออกมาประกาศเป็นตัวแปรชื่อ $num
if($num <=0) {
    echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านที่คุณได้ป้อน ไม่ตรงกับบัญชีใด ๆ!');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
} else {
        while($data=mysql_fetch_array($check_log) ) {
                $_SESSION[ses_userid] = session_id();       
                $_SESSION[loginid] = $data[user_id];
                echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
        }
        
}
?>
