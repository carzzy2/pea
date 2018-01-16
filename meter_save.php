<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
if($_POST[txtmode]=="add"){ 
        $sql="insert into tb_meter(me_id,me_name,me_price,me_insure,me_type) 
        values('".$_POST[me_id]."','".$_POST[me_name]."','".$_POST[me_price]."','".$_POST[me_insure]."','".$_POST[me_type]."')";
        mysql_query($sql);
        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=meter_show.php'> "; 
}elseif($_POST[txtmode]=="edit"){
    $sql="update tb_meter set me_name='".$_POST[me_name]."',me_price='".$_POST[me_price]."',me_insure='".$_POST[me_insure]."',me_type='".$_POST[me_type]."' where me_id='".$_POST[me_id]."'";
    mysql_query($sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=meter_show.php'> ";	
}elseif($_GET[mode]=="del"){
    
    $sql2="SELECT * FROM tb_equipment WHERE me_id='".$_GET[id]."'";
    $res2 = mysql_query($sql2);
    $count2 = mysql_num_rows($res2);

    if($count2 > 0){
        echo "<script>alert('ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลมีความสัมพันธ์กับตารางข้อมูลอื่น');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=meter_show.php'> ";
    }else{
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');</script>";
        $sql="delete from tb_meter where me_id='".$_GET[id]."'";
        mysql_query($sql);
        echo "<META http-equiv='refresh' Content='0; URL=meter_show.php'> ";
    }
    	

}

?>