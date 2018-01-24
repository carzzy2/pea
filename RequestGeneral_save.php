<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
if($_POST['rg_want_type']=="0"){
    $sql_f="select * from tb_electricity where cus_id='".$_SESSION[ss_cus_id]."' and re_want_type='0' and re_pay='0' and re_status='6' ";
    $result_f=mysql_db_query($dbname,$sql_f);
    if(mysql_num_rows($result_f)==0){
        echo "<script>alert('ไม่สามารถบันทึกได้เนื่องจากยังไม่มีข้อมูลการติดตั้งมิเตอร์ในระบบ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=RequestGeneral_part4.php'> ";
        exit();
    }
}
if($_SESSION[ss_rg_place_type]=="1" ){
    $other="-";
}elseif($_SESSION[ss_rg_place_type]=="2"){
    $other="-";
}else{
    $other=$_SESSION[ss_rg_place_other];
}
if($_POST[rg_want_type]=="12" ){
    $other2=$_POST[rg_want_other];
}else{
    $other2="-";
}
if($_POST[rg_detail]=="" ){
    $other3="-";
}else{
    $other3=$_POST[rg_detail];
}
    $status=0;

if($_SESSION[ss_add]=="oldcus"){ 
        $sql="insert into tb_general(rg_id,rg_date,rg_branch,user_id,cus_id,
            rg_place_type,rg_place_other,rg_place_name,
            rg_place_homeid,rg_place_number,rg_place_village,rg_place_room,rg_place_floor,
            rg_place_alley,rg_place_alleyway,rg_place_road,rg_place_villno,
            rg_place_district,rg_place_canton,rg_place_province,rg_place_post,rg_place_tel,rg_place_fax,rg_place_email,rg_place_service,
            rg_contact_place,rg_contact_homeid,rg_contact_number,rg_contact_village,rg_contact_room,rg_contact_floor,rg_contact_alley,rg_contact_alleyway,rg_contact_road,rg_contact_villno,rg_contact_district,rg_contact_canton,rg_contact_province,rg_contact_post,rg_contact_tel,rg_contact_fax,rg_contact_email,
            rg_want_type,rg_want_other,rg_detail,rg_status) 
        values('".$_POST[rg_id]."',NOW(),'".$_SESSION[ss_rg_branch]."','".$_SESSION[loginid]."','".$_SESSION[ss_cus_id]."'"
                . ",'".$_SESSION[ss_rg_place_type]."','".$other."','".$_SESSION[ss_rg_place_name]."'"
                . ",'".$_SESSION[ss_rg_place_homeid]."','".$_SESSION[ss_rg_place_number]."','".$_SESSION[ss_rg_place_village]."','".$_SESSION[ss_rg_place_room]."','".$_SESSION[ss_rg_place_floor]."'"
                . ",'".$_SESSION[ss_rg_place_alley]."','".$_SESSION[ss_rg_place_alleyway]."','".$_SESSION[ss_rg_place_road]."','".$_SESSION[ss_rg_place_villno]."','".$_SESSION[ss_rg_place_district]."','".$_SESSION[ss_rg_place_canton]."','".$_SESSION[ss_rg_place_province]."','".$_SESSION[ss_rg_place_post]."','".$_SESSION[ss_rg_place_tel]."','".$_SESSION[ss_rg_place_fax]."','".$_SESSION[ss_rg_place_email]."','".$_SESSION[ss_rg_place_service]."'"
                . ",'".$_SESSION[ss_rg_contact_place]."','".$_SESSION[ss_rg_contact_homeid]."','".$_SESSION[ss_rg_contact_number]."','".$_SESSION[ss_rg_contact_village]."','".$_SESSION[ss_rg_contact_room]."','".$_SESSION[ss_rg_contact_floor]."','".$_SESSION[ss_rg_contact_alley]."','".$_SESSION[ss_rg_contact_alleyway]."','".$_SESSION[ss_rg_contact_road]."','".$_SESSION[ss_rg_contact_villno]."','".$_SESSION[ss_rg_contact_district]."','".$_SESSION[ss_rg_contact_canton]."','".$_SESSION[ss_rg_contact_province]."','".$_SESSION[ss_rg_contact_post]."','".$_SESSION[ss_rg_contact_tel]."','".$_SESSION[ss_rg_contact_fax]."','".$_SESSION[ss_rg_contact_email]."'"
                . ",'".$_POST[rg_want_type]."','".$other2."','".$other3."','".$status."')";
        mysql_query($sql);

    session_unregister('ss_rg_branch');
    session_unregister('ss_cus_id');
    session_unregister('ss_cus_first');
    session_unregister('ss_cus_name');
    session_unregister('ss_cus_type');
    session_unregister('ss_cus_tax');
    session_unregister('ss_cus_code');
    session_unregister('ss_cus_homeid');
    session_unregister('ss_cus_number');
    session_unregister('ss_cus_village');
    session_unregister('ss_cus_room');
    session_unregister('ss_cus_floor');
    session_unregister('ss_cus_alley');
    session_unregister('ss_cus_alleyway');
    session_unregister('ss_cus_road');
    session_unregister('ss_cus_vilno');
    session_unregister('ss_cus_district');
    session_unregister('ss_cus_canton');
    session_unregister('ss_cus_province');
    session_unregister('ss_cus_post');
    session_unregister('ss_cus_tel');
    session_unregister('ss_cus_fax');
    session_unregister('ss_cus_road');
    session_unregister('ss_cus_email');
    
    session_unregister('ss_rg_place_type');
    session_unregister('ss_rg_place_other');
    session_unregister('ss_rg_place_name');
    
    session_unregister('ss_rg_place_homeid');
    session_unregister('ss_rg_place_number');
    session_unregister('ss_rg_place_village');
    session_unregister('ss_rg_place_room');
    session_unregister('ss_rg_place_floor');
    session_unregister('ss_rg_place_alley');
    session_unregister('ss_rg_place_alleyway');
    session_unregister('ss_cus_email');
    session_unregister('ss_rg_place_road');
    session_unregister('ss_rg_place_vilno');
    session_unregister('ss_rg_place_district');
    session_unregister('ss_rg_place_canton');
    session_unregister('ss_rg_place_province');
    session_unregister('ss_rg_place_post');
    session_unregister('ss_rg_place_tel');
    session_unregister('ss_rg_place_fax');
    session_unregister('ss_rg_place_road');
    session_unregister('ss_rg_place_email');
    session_unregister('ss_rg_place_service');
    
    session_unregister('ss_rg_contact_homeid');
    session_unregister('ss_rg_contact_number');
    session_unregister('ss_rg_contact_village');
    session_unregister('ss_rg_contact_room');
    session_unregister('ss_rg_contact_floor');
    session_unregister('ss_rg_contact_alley');
    session_unregister('ss_rg_contact_alleyway');
    session_unregister('ss_rg_contact_road');
    session_unregister('ss_rg_contact_vilno');
    session_unregister('ss_rg_contact_district');
    session_unregister('ss_rg_contact_canton');
    session_unregister('ss_rg_contact_province');
    session_unregister('ss_rg_contact_post');
    session_unregister('ss_rg_contact_tel');
    session_unregister('ss_rg_contact_fax');
    session_unregister('ss_rg_contact_road');
    session_unregister('ss_rg_contact_email');
    session_unregister('ss_rg_contact_service');

        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=RequestGeneral_plate.php?rg_id=$_POST[rg_id]'> ";
            
}else{
    $sql_find="select cus_id from tb_customer where cus_id='".$_SESSION[ss_cus_id]."'";
    $result_find=mysql_db_query($dbname,$sql_find);
    if(mysql_num_rows($result_find)>0){
	echo "<script>alert('รหัสประชาชนที่หรอก:".$_SESSION[ss_cus_id]."มีอยู่แล้วในระบบ');</script>";
	echo "<META http-equiv='refresh' Content='0; URL=RequestGeneral_part1.php'> ";
    }else{
        $sql="insert into tb_customer(cus_id,cus_first,cus_name,cus_type,cus_code,cus_tax,cus_homeid,cus_number,cus_village,cus_room,cus_floor,cus_alley,cus_alleyway,cus_road,cus_vilno,cus_district,cus_canton,cus_province,cus_post,cus_tel,cus_fax,cus_email) 
        values('".$_SESSION[ss_cus_id]."','".$_SESSION[ss_cus_first]."','".$_SESSION[ss_cus_name]."','".$_SESSION[ss_cus_type]."','".$_SESSION[ss_cus_code]."','".$_SESSION[ss_cus_tax]."','".$_SESSION[ss_cus_homeid]."','".$_SESSION[ss_cus_number]."','".$_SESSION[ss_cus_village]."','".$_SESSION[ss_cus_room]."','".$_SESSION[ss_cus_floor]."','".$_SESSION[ss_cus_alley]."','".$_SESSION[ss_cus_alleyway]."','".$_SESSION[ss_cus_road]."','".$_SESSION[ss_cus_vilno]."','".$_SESSION[ss_cus_district]."','".$_SESSION[ss_cus_canton]."','".$_SESSION[ss_cus_province]."','".$_SESSION[ss_cus_post]."','".$_SESSION[ss_cus_tel]."','".$_SESSION[ss_cus_fax]."','".$_SESSION[ss_cus_email]."')";
        mysql_query($sql);
        
        $sql2="insert into tb_general(rg_id,rg_date,rg_branch,user_id,cus_id,
            rg_place_type,rg_place_other,rg_place_name,
            rg_place_homeid,rg_place_number,rg_place_village,rg_place_room,rg_place_floor,
            rg_place_alley,rg_place_alleyway,rg_place_road,rg_place_villno,
            rg_place_district,rg_place_canton,rg_place_province,rg_place_post,rg_place_tel,rg_place_fax,rg_place_email,rg_place_service,
            rg_contact_place,rg_contact_homeid,rg_contact_number,rg_contact_village,rg_contact_room,rg_contact_floor,rg_contact_alley,rg_contact_alleyway,rg_contact_road,rg_contact_villno,rg_contact_district,rg_contact_canton,rg_contact_province,rg_contact_post,rg_contact_tel,rg_contact_fax,rg_contact_email,
            rg_want_type,rg_want_other,rg_detail,rg_status) 
        values('".$_POST[rg_id]."',NOW(),'".$_SESSION[ss_rg_branch]."','".$_SESSION[loginid]."','".$_SESSION[ss_cus_id]."'"
                . ",'".$_SESSION[ss_rg_place_type]."','".$other."','".$_SESSION[ss_rg_place_name]."'"
                . ",'".$_SESSION[ss_rg_place_homeid]."','".$_SESSION[ss_rg_place_number]."','".$_SESSION[ss_rg_place_village]."','".$_SESSION[ss_rg_place_room]."','".$_SESSION[ss_rg_place_floor]."'"
                . ",'".$_SESSION[ss_rg_place_alley]."','".$_SESSION[ss_rg_place_alleyway]."','".$_SESSION[ss_rg_place_road]."','".$_SESSION[ss_rg_place_villno]."','".$_SESSION[ss_rg_place_district]."','".$_SESSION[ss_rg_place_canton]."','".$_SESSION[ss_rg_place_province]."','".$_SESSION[ss_rg_place_post]."','".$_SESSION[ss_rg_place_tel]."','".$_SESSION[ss_rg_place_fax]."','".$_SESSION[ss_rg_place_email]."','".$_SESSION[ss_rg_place_service]."'"
                . ",'".$_SESSION[ss_rg_contact_place]."','".$_SESSION[ss_rg_contact_homeid]."','".$_SESSION[ss_rg_contact_number]."','".$_SESSION[ss_rg_contact_village]."','".$_SESSION[ss_rg_contact_room]."','".$_SESSION[ss_rg_contact_floor]."','".$_SESSION[ss_rg_contact_alley]."','".$_SESSION[ss_rg_contact_alleyway]."','".$_SESSION[ss_rg_contact_road]."','".$_SESSION[ss_rg_contact_villno]."','".$_SESSION[ss_rg_contact_district]."','".$_SESSION[ss_rg_contact_canton]."','".$_SESSION[ss_rg_contact_province]."','".$_SESSION[ss_rg_contact_post]."','".$_SESSION[ss_rg_contact_tel]."','".$_SESSION[ss_rg_contact_fax]."','".$_SESSION[ss_rg_contact_email]."'"
                . ",'".$_POST[rg_want_type]."','".$other2."','".$other3."','".$status."')";

        mysql_query($sql2);
    session_unregister('ss_rg_branch');
    session_unregister('ss_cus_id');
    session_unregister('ss_cus_first');
    session_unregister('ss_cus_name');
    session_unregister('ss_cus_type');
    session_unregister('ss_cus_tax');
    session_unregister('ss_cus_code');
    session_unregister('ss_cus_homeid');
    session_unregister('ss_cus_number');
    session_unregister('ss_cus_village');
    session_unregister('ss_cus_room');
    session_unregister('ss_cus_floor');
    session_unregister('ss_cus_alley');
    session_unregister('ss_cus_alleyway');
    session_unregister('ss_cus_road');
    session_unregister('ss_cus_vilno');
    session_unregister('ss_cus_district');
    session_unregister('ss_cus_canton');
    session_unregister('ss_cus_province');
    session_unregister('ss_cus_post');
    session_unregister('ss_cus_tel');
    session_unregister('ss_cus_fax');
    session_unregister('ss_cus_road');
    session_unregister('ss_cus_email');
    
    session_unregister('ss_rg_place_type');
    session_unregister('ss_rg_place_other');
    session_unregister('ss_rg_place_name');
    session_unregister('ss_rg_place_homeid');
    session_unregister('ss_rg_place_number');
    session_unregister('ss_rg_place_village');
    session_unregister('ss_rg_place_room');
    session_unregister('ss_rg_place_floor');
    session_unregister('ss_rg_place_alley');
    session_unregister('ss_rg_place_alleyway');
    session_unregister('ss_cus_email');
    session_unregister('ss_rg_place_road');
    session_unregister('ss_rg_place_vilno');
    session_unregister('ss_rg_place_district');
    session_unregister('ss_rg_place_canton');
    session_unregister('ss_rg_place_province');
    session_unregister('ss_rg_place_post');
    session_unregister('ss_rg_place_tel');
    session_unregister('ss_rg_place_fax');
    session_unregister('ss_rg_place_road');
    session_unregister('ss_rg_place_email');
    session_unregister('ss_rg_place_service');
        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=RequestGeneral_plate.php?rg_id=$_POST[rg_id]'> ";
    }

    
}
?>