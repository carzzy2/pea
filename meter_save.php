<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
if($_POST[txtmode]=="add"){ 
        $sql="insert into tb_meter(me_id,me_name,me_price,me_type) 
        values('".$_POST[me_id]."','".$_POST[me_name]."','".$_POST[me_price]."','".$_POST[me_type]."')";
        mysql_query($sql);
        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=meter_show.php'> "; 
}elseif($_POST[txtmode]=="edit"){
    $sql="update tb_meter set me_name='".$_POST[me_name]."',me_price='".$_POST[me_price]."',me_type='".$_POST[me_type]."' where me_id='".$_POST[me_id]."'";
    mysql_query($sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=meter_show.php'> ";	
}elseif($_GET[mode]=="del"){
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');</script>";
    $sql="delete from tb_meter where me_id='".$_GET[id]."'";
    mysql_query($sql);
    echo "<META http-equiv='refresh' Content='0; URL=meter_show.php'> ";	

}
//elseif($_POST[txtmode]=="insert"){
//    $sql_mat="select * from tb_meter where me_type='0'";
//    $result_mat=mysql_db_query($dbname,$sql_mat);
//    while($array_mat=mysql_fetch_array($result_mat)){
//        $new_id =mysql_result(mysql_query("Select Max(substr(me_id,-4))+1 as MaxID from tb_meter"),0,"MaxID" );
//        if($new_id==''){ // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
//        $std_id="ME00001";
//        }else{
//        $std_id="ME".sprintf("%05d",$new_id);//ถ้าไม่ใช่ค่าว่าง
//        }
//         $sql="insert into tb_meter(me_id,me_name,me_price,me_type) 
//        values('".$std_id."','".$array_mat[me_name]."','".$array_mat[me_price]."','".$_POST[me_type]."')";
//        mysql_query($sql);
//    }
//        
//    echo "<META http-equiv='refresh' Content='0; URL=meter_show.php'> ";	
//	
//}
?>