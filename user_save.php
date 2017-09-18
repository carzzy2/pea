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
        $data = mysql_fetch_array($dbquery);
        if($data[user_pos]==0){
            $sql_findboss ="select * from tb_user where user_pos='0'";
            $dbqueryboss=mysql_db_query($dbname,$sql_findboss);
            $num = mysql_num_rows($dbqueryboss);
            if($num<2){
                echo "<script>alert('ไม่สามารถลบได้! ต้องมี admin 1 คนในระบบ');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=user_show.php'>";
                exit();
            }else{
                echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');</script>";
                $sql="delete from tb_user where user_id='".$_GET[id]."'";
                mysql_query($sql);
                echo "<meta http-equiv='refresh' content='0;URL=user_show.php'>";
            }
        }else{
                $sql1="SELECT * FROM tb_general WHERE user_id='".$_GET[id]."'";
                $res1 = mysql_query($sql1);
                $count1 = mysql_num_rows($res1);
                
                $sql2="SELECT * FROM tb_electricity WHERE user_id='".$_GET[id]."'";
                $res2 = mysql_query($sql2);
                $count2 = mysql_num_rows($res2);
                
                $sql3="SELECT * FROM tb_equipment WHERE user_id='".$_GET[id]."'";
                $res3 = mysql_query($sql3);
                $count3 = mysql_num_rows($res3);
                
                $sql4="SELECT * FROM tb_fee WHERE user_id='".$_GET[id]."'";
                $res4 = mysql_query($sql4);
                $count4 = mysql_num_rows($res4);
                
                $sql5="SELECT * FROM tb_work WHERE user_id='".$_GET[id]."'";
                $res5 = mysql_query($sql5);
                $count5 = mysql_num_rows($res5);
                
                $sql6="SELECT * FROM tb_work_detail WHERE user_id='".$_GET[id]."'";
                $res6 = mysql_query($sql6);
                $count6 = mysql_num_rows($res6);
                
                if($count1 or $count2 or $count3 or $count4 or $count5 or $count6 > 0){
                    echo "<script>alert('ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลมีความสัมพันธ์กับตารางข้อมูลอื่น');</script>";
                    echo "<META http-equiv='refresh' Content='0; URL=user_show.php'> ";
                }else{
                    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');</script>";
                    $sqldel="delete from tb_user where user_id='".$_GET[id]."'";
                    mysql_query($sqldel);
                    echo "<META http-equiv='refresh' Content='0; URL=user_show.php'> ";	
                }
            
            

        }
        
    }
}
?>