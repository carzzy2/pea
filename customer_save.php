<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
if($_POST[txtmode]=="add"){ 
    $sql_find="select cus_id from tb_customer where cus_id='".$_POST[cus_id]."'";
    $result_find=mysql_db_query($dbname,$sql_find);
    if(mysql_num_rows($result_find)>0){
	echo "<script>alert('รหัสประชาชนที่หรอก:".$_POST[cus_id]."มีอยู่แล้วในระบบ');</script>";
	echo "<META http-equiv='refresh' Content='0; URL=customer_add.php'> ";
    }else{
        $sql="insert into tb_customer(cus_id,cus_first,cus_name,cus_type,cus_code,cus_tax,cus_homeid,cus_number,cus_village,cus_room,cus_floor,cus_alley,cus_alleyway,cus_road,cus_vilno,cus_district,cus_canton,cus_province,cus_post,cus_tel,cus_fax,cus_email) 
        values('".$_POST[cus_id]."','".$_POST[cus_first]."','".$_POST[cus_name]."','".$_POST[cus_type]."','".$_POST[cus_code]."','".$_POST[cus_tax]."','".$_POST[cus_homeid]."','".$_POST[cus_number]."','".$_POST[cus_village]."','".$_POST[cus_room]."','".$_POST[cus_floor]."','".$_POST[cus_alley]."','".$_POST[cus_alleyway]."','".$_POST[cus_road]."','".$_POST[cus_vilno]."','".$_POST[cus_district]."','".$_POST[cus_canton]."','".$_POST[cus_province]."','".$_POST[cus_post]."','".$_POST[cus_tel]."','".$_POST[cus_fax]."','".$_POST[cus_email]."')";
        mysql_query($sql);
        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=customer_show.php'> "; 
    }
}elseif($_POST[txtmode]=="edit"){
    $sql="update tb_customer set cus_id='".$_POST[cus_id]."',cus_first='".$_POST[cus_first]."',cus_name='".$_POST[cus_name]."'"
            . ",cus_type='".$_POST[cus_type]."',cus_code='".$_POST[cus_code]."',cus_tax='".$_POST[cus_tax]."'"
            . ",cus_homeid='".$_POST[cus_homeid]."',cus_number='".$_POST[cus_number]."',cus_village='".$_POST[cus_village]."'"
            . ",cus_room='".$_POST[cus_room]."',cus_floor='".$_POST[cus_floor]."'"
            . ",cus_alley='".$_POST[cus_alley]."',cus_alleyway='".$_POST[cus_alleyway]."',cus_road='".$_POST[cus_road]."'"
            . ",cus_vilno='".$_POST[cus_vilno]."',cus_district='".$_POST[cus_district]."',cus_canton='".$_POST[cus_canton]."'"
            . ",cus_province='".$_POST[cus_province]."',cus_post='".$_POST[cus_post]."',cus_tel='".$_POST[cus_tel]."',cus_fax='".$_POST[cus_fax]."' ,cus_email='".$_POST[cus_email]."' "
            . " where cus_id='".$_POST[cus_id]."'";
    mysql_query($sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=customer_show.php'> ";	
}elseif($_GET[mode]=="del"){
    
    $sql1="SELECT * FROM tb_general WHERE cus_id='".$_GET[id]."'";
    $res1 = mysql_query($sql1);
    $count1 = mysql_num_rows($res1);
    
    $sql2="SELECT * FROM tb_electricity WHERE cus_id='".$_GET[id]."'";
    $res2 = mysql_query($sql2);
    $count2 = mysql_num_rows($res2);

    if($count1 or $count2 > 0){
        echo "<script>alert('ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลมีความสัมพันธ์กับตารางข้อมูลอื่น');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=customer_show.php'> ";
    }else{
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');</script>";
        $sql="delete from tb_customer where cus_id='".$_GET[id]."'";
        mysql_query($sql);
        echo "<META http-equiv='refresh' Content='0; URL=customer_show.php'> ";	
    }

}
?>