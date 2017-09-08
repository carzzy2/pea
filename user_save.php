<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
if($_POST[txtmode]=="add"){ 
    $sql_find="select user_code from tb_user where user_code='".$_POST[user_code]."'";
    $result_find=mysql_db_query($dbname,$sql_find);
    if(mysql_num_rows($result_find)>0){
	echo "<script>alert('รหัสประชาชนที่หรอก:".$_POST[username]."มีอยู่แล้วในระบบ');</script>";
	echo "<META http-equiv='refresh' Content='0; URL=user_add.php'> ";
    }else{
        $sql="insert into tb_user(user_id,user_code,user_first,user_name,user_last,user_add,user_tel,user_pos,user_pass) 
        values('".$_POST[user_id]."','".$_POST[user_code]."','".$_POST[user_first]."','".$_POST[user_name]."','".$_POST[user_last]."','".$_POST[user_add]."','".$_POST[user_tel]."','1','".$_POST[user_pass]."')";
        mysql_query($sql);
        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=user_show.php'> "; 
    }
}elseif($_POST[txtmode]=="edit"){
    $sql="update tb_user set user_id='".$_POST[user_id]."',user_code='".$_POST[user_code]."',user_first='".$_POST[user_first]."',user_name='".$_POST[user_name]."',user_last='".$_POST[user_last]."',user_add='".$_POST[user_add]."',user_tel='".$_POST[user_tel]."',user_pass='".$_POST[user_pass]."'"
            . "where user_id='".$_POST[user_id]."'";
    mysql_query($sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=user_show.php'> ";	
}elseif($_GET[mode]=="del"){
    if($_SESSION[loginid]==$_GET[id] ){
        echo "<script>alert('ไม่สามารถลบได้!เนื่องจากกำลังเข้าสู่ระบบอยู่');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=user_show.php'>";
    }else{
        $sql_find ="select * from  tb_user where user_id='".$_GET[id]."'";
        $dbquery=mysql_db_query($dbname,$sql_find);
        while ($data = mysql_fetch_array($dbquery) ) {
            if($data[user_pos]==0){
                $sql_findboss ="select * from tb_user where user_pos='0'";
                $dbqueryboss=mysql_db_query($dbname,$sql_findboss);
                $num = mysql_num_rows($dbqueryboss);
                if($num<2){
                    echo "<script>alert('ไม่สามารถลบได้! ต้องมี admin 1 คนในระบบ');</script>";
                    echo "<meta http-equiv='refresh' content='0;URL=user_show.php'>";
                }else{
                    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');</script>";
                    $sql="delete from tb_user where user_id='".$_GET[id]."'";
                    mysql_query($sql);
                    echo "<meta http-equiv='refresh' content='0;URL=user_show.php'>";
                }
            }else{
                echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');</script>";
                $sql="delete from tb_user where user_id='".$_GET[id]."'";
                mysql_query($sql);
                echo "<META http-equiv='refresh' Content='0; URL=user_show.php'> ";	

            }
        }
    }
}
?>