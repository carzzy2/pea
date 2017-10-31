<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
$new_id =mysql_result(mysql_query("Select Max(substr(re_id,-4))+1 as MaxID from tb_electricity"),0,"MaxID" );
    if($new_id==''){
        $re_id="120000000001";
    }else{
        $re_id="12".sprintf("%010d",$new_id);
    }
$dir="../pea/img/ele/".$re_id.".jpg";
if (is_uploaded_file($HTTP_POST_FILES['file']['tmp_name'])){
    copy($HTTP_POST_FILES['file']['tmp_name'], "$dir");
}else{
    echo "Upload not complete";
}	
	
if($_SESSION[re_place_type]=="0" ){
    $other="-";
}elseif( $_SESSION[re_place_type]=="1"){
    $other="-";
}else{
    $other=$_SESSION[re_place_other];
}
if($_SESSION[re_want_type]=="16" ){
    $other2=$_SESSION[re_want_other];
}else{
    $other2="-";
}
if($_SESSION[re_detail]=="" ){
    $other3="-";
}else{
    $other3=$_SESSION[re_detail];
}
if($_SESSION[re_want_type]=="1" or $_SESSION[re_want_type]=="5" or $_SESSION[re_want_type]=="6" or $_SESSION[re_want_type]=="7" or $_SESSION[re_want_type]=="8" or $_SESSION[re_want_type]=="9" or $_SESSION[re_want_type]=="14"){
    $status="4";
}else{
     $status="0";
}
$_SESSION['re_dateset']=$_POST[re_dateset];
$_SESSION['re_keep_type']=$_POST[re_keep_type];
$_SESSION['re_keep_name']=$_POST[re_keep_name];
$_SESSION['re_keep_homeid']=$_POST[re_keep_homeid];
$_SESSION['re_keep_number']=$_POST[re_keep_number];
$_SESSION['re_keep_village']=$_POST[re_keep_village];
$_SESSION['re_keep_room']=$_POST[re_keep_room];
$_SESSION['re_keep_floor']=$_POST[re_keep_floor];
$_SESSION['re_keep_alley']=$_POST[re_keep_alley];
$_SESSION['re_keep_alleyway']=$_POST[re_keep_alleyway];
$_SESSION['re_keep_road']=$_POST[re_keep_road];
$_SESSION['re_keep_villno']=$_POST[re_keep_villno];
$_SESSION['re_keep_district']=$_POST[re_keep_district];
$_SESSION['re_keep_canton']=$_POST[re_keep_canton];
$_SESSION['re_keep_province']=$_POST[re_keep_province];
$_SESSION['re_keep_post']=$_POST[re_keep_post];
$_SESSION['re_keep_tel']=$_POST[re_keep_tel];
$_SESSION['re_keep_fax']=$_POST[re_keep_fax];
$_SESSION['re_keep_email']=$_POST[re_keep_email];
    $sql_find="select cus_id from tb_customer where cus_id='".$_SESSION[cus_id]."'";
    $result_find=mysql_db_query($dbname,$sql_find);
    if(mysql_num_rows($result_find)>0){
        $sql="insert into tb_electricity(re_id,re_date,re_branch,user_id,cus_id,re_place_type,re_place_other,re_place_name,
            re_place_homeid,re_place_number,re_place_village,re_place_room,re_place_floor,re_place_alley,re_place_alleyway,
			re_place_road,re_place_villno,re_place_district,re_place_canton,re_place_province,re_place_post,re_place_tel,
			re_place_fax,re_place_email,re_place_service,re_contact_place,re_contact_homeid,re_contact_number,
			re_contact_village,re_contact_room,re_contact_floor,re_contact_alley,re_contact_alleyway,re_contact_road,
			re_contact_villno,re_contact_district,re_contact_canton,re_contact_province,re_contact_post,re_contact_tel,
			re_contact_fax,re_contact_email,re_want_type,re_want_other,re_detail,re_use_type,re_use_other,
			re_dateset,re_keep_type,re_keep_name,re_keep_homeid,re_keep_number,re_keep_village,re_keep_room,
			re_keep_floor,re_keep_alley,re_keep_alleyway,re_keep_road,re_keep_villno,re_keep_district,re_keep_canton,
			re_keep_province,re_keep_post,re_keep_tel,re_keep_fax,re_keep_email,re_picture,re_status) 
        values('".$re_id."',NOW(),'".$_SESSION[rg_branch]."','".$_SESSION[loginid]."','".$_SESSION[cus_id]."'"
                . ",'".$_SESSION[re_place_type]."','".$other."','".$_SESSION[re_place_name]."'"
                . ",'".$_SESSION[re_place_homeid]."','".$_SESSION[re_place_number]."','".$_SESSION[re_place_village]."',
				'".$_SESSION[re_place_room]."','".$_SESSION[re_place_floor]."'"
                . ",'".$_SESSION[re_place_alley]."','".$_SESSION[re_place_alleyway]."','".$_SESSION[re_place_road]."',
				'".$_SESSION[re_place_villno]."','".$_SESSION[re_place_district]."','".$_SESSION[re_place_canton]."',
				'".$_SESSION[re_place_province]."','".$_SESSION[re_place_post]."','".$_SESSION[re_place_tel]."',
				'".$_SESSION[re_place_fax]."','".$_SESSION[re_place_email]."','".$_SESSION[re_place_service]."'"
                . ",'".$_SESSION[re_contact_place]."','".$_SESSION[re_contact_homeid]."','".$_SESSION[re_contact_number]."',
				'".$_SESSION[re_contact_village]."','".$_SESSION[re_contact_room]."','".$_SESSION[re_contact_floor]."',
				'".$_SESSION[re_contact_alley]."','".$_SESSION[re_contact_alleyway]."','".$_SESSION[re_contact_road]."',
				'".$_SESSION[re_contact_villno]."','".$_SESSION[re_contact_district]."','".$_SESSION[re_contact_canton]."',
				'".$_SESSION[re_contact_province]."','".$_SESSION[re_contact_post]."','".$_SESSION[re_contact_tel]."',
				'".$_SESSION[re_contact_fax]."','".$_SESSION[re_contact_email]."'"
                . ",'".$_SESSION[re_want_type]."','".$other2."','".$other3."'"
                . ",'".$_SESSION[re_use_type]."','".$_SESSION[re_use_other]."','".$_SESSION[re_dateset]."'"
                . ",'".$_SESSION[re_keep_type]."','".$_SESSION[re_keep_name]."'"
                . ",'".$_SESSION[re_keep_homeid]."','".$_SESSION[re_keep_number]."','".$_SESSION[re_keep_village]."',
				'".$_SESSION[re_keep_room]."','".$_SESSION[re_keep_floor]."','".$_SESSION[re_keep_alley]."',
				'".$_SESSION[re_keep_alleyway]."','".$_SESSION[re_keep_road]."','".$_SESSION[re_keep_villno]."',
				'".$_SESSION[re_keep_district]."','".$_SESSION[re_keep_canton]."','".$_SESSION[re_keep_province]."',
				'".$_SESSION[re_keep_post]."','".$_SESSION[re_keep_tel]."','".$_SESSION[re_keep_fax]."',
				'".$_SESSION[re_keep_email]."','".$dir."','".$status."')";
        mysql_query($sql);
        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=RequestElectricity_plate.php?re_id=$re_id'> ";
    }else{
        $sqll="insert into tb_customer(cus_id,cus_first,cus_name,cus_type,cus_code,cus_tax,cus_homeid,cus_number,cus_village,cus_room,cus_floor,cus_alley,cus_alleyway,cus_road,cus_vilno,cus_district,cus_canton,cus_province,cus_post,cus_tel,cus_fax,cus_email) 
        values('".$_SESSION[cus_id]."','".$_SESSION[cus_first]."','".$_SESSION[cus_name]."','".$_SESSION[cus_type]."'
		,'".$_SESSION[cus_code]."','".$_SESSION[cus_tax]."','".$_SESSION[cus_homeid]."','".$_SESSION[cus_number]."'
		,'".$_SESSION[cus_village]."','".$_SESSION[cus_room]."','".$_SESSION[cus_floor]."','".$_SESSION[cus_alley]."'
		,'".$_SESSION[cus_alleyway]."','".$_SESSION[cus_road]."','".$_SESSION[cus_vilno]."','".$_SESSION[cus_district]."'
		,'".$_SESSION[cus_canton]."','".$_SESSION[cus_province]."','".$_SESSION[cus_post]."','".$_SESSION[cus_tel]."'
		,'".$_SESSION[cus_fax]."','".$_SESSION[cus_email]."')";
        mysql_query($sqll);
        $sql="insert into tb_electricity(re_id,re_date,re_branch,user_id,cus_id,re_place_type,re_place_other,re_place_name,
            re_place_homeid,re_place_number,re_place_village,re_place_room,re_place_floor,re_place_alley,re_place_alleyway,
			re_place_road,re_place_villno,re_place_district,re_place_canton,re_place_province,re_place_post,re_place_tel,
			re_place_fax,re_place_email,re_place_service,re_contact_place,re_contact_homeid,re_contact_number,
			re_contact_village,re_contact_room,re_contact_floor,re_contact_alley,re_contact_alleyway,re_contact_road,
			re_contact_villno,re_contact_district,re_contact_canton,re_contact_province,re_contact_post,re_contact_tel,
			re_contact_fax,re_contact_email,re_want_type,re_want_other,re_detail,re_use_type,re_use_other,
			re_dateset,re_keep_type,re_keep_name,re_keep_homeid,re_keep_number,re_keep_village,re_keep_room,
			re_keep_floor,re_keep_alley,re_keep_alleyway,re_keep_road,re_keep_villno,re_keep_district,re_keep_canton,
			re_keep_province,re_keep_post,re_keep_tel,re_keep_fax,re_keep_email,re_picture,re_status) 
        values('".$re_id."',NOW(),'".$_SESSION[rg_branch]."','".$_SESSION[loginid]."','".$_SESSION[cus_id]."'"
                . ",'".$_SESSION[re_place_type]."','".$other."','".$_SESSION[re_place_name]."'"
                . ",'".$_SESSION[re_place_homeid]."','".$_SESSION[re_place_number]."','".$_SESSION[re_place_village]."',
				'".$_SESSION[re_place_room]."','".$_SESSION[re_place_floor]."'"
                . ",'".$_SESSION[re_place_alley]."','".$_SESSION[re_place_alleyway]."','".$_SESSION[re_place_road]."',
				'".$_SESSION[re_place_villno]."','".$_SESSION[re_place_district]."','".$_SESSION[re_place_canton]."',
				'".$_SESSION[re_place_province]."','".$_SESSION[re_place_post]."','".$_SESSION[re_place_tel]."',
				'".$_SESSION[re_place_fax]."','".$_SESSION[re_place_email]."','".$_SESSION[re_place_service]."'"
                . ",'".$_SESSION[re_contact_place]."','".$_SESSION[re_contact_homeid]."','".$_SESSION[re_contact_number]."',
				'".$_SESSION[re_contact_village]."','".$_SESSION[re_contact_room]."','".$_SESSION[re_contact_floor]."',
				'".$_SESSION[re_contact_alley]."','".$_SESSION[re_contact_alleyway]."','".$_SESSION[re_contact_road]."',
				'".$_SESSION[re_contact_villno]."','".$_SESSION[re_contact_district]."','".$_SESSION[re_contact_canton]."',
				'".$_SESSION[re_contact_province]."','".$_SESSION[re_contact_post]."','".$_SESSION[re_contact_tel]."',
				'".$_SESSION[re_contact_fax]."','".$_SESSION[re_contact_email]."'"
                . ",'".$_SESSION[re_want_type]."','".$other2."','".$other3."'"
                . ",'".$_SESSION[re_use_type]."','".$_SESSION[re_use_other]."','".$_SESSION[re_dateset]."'"
                . ",'".$_SESSION[re_keep_type]."','".$_SESSION[re_keep_name]."'"
                . ",'".$_SESSION[re_keep_homeid]."','".$_SESSION[re_keep_number]."','".$_SESSION[re_keep_village]."',
				'".$_SESSION[re_keep_room]."','".$_SESSION[re_keep_floor]."','".$_SESSION[re_keep_alley]."',
				'".$_SESSION[re_keep_alleyway]."','".$_SESSION[re_keep_road]."','".$_SESSION[re_keep_villno]."',
				'".$_SESSION[re_keep_district]."','".$_SESSION[re_keep_canton]."','".$_SESSION[re_keep_province]."',
				'".$_SESSION[re_keep_post]."','".$_SESSION[re_keep_tel]."','".$_SESSION[re_keep_fax]."',
				'".$_SESSION[re_keep_email]."','".$dir."','".$status."')";
        mysql_query($sql);
        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=RequestElectricity_plate.php?re_id=$re_id'> ";
	}
	session_unregister('rg_branch');
        session_unregister('cus_first');
        session_unregister('cus_name');
        session_unregister('cus_type');
        session_unregister('cus_id');
        session_unregister('cus_tax');
        session_unregister('cus_code');
        session_unregister('cus_homeid');
        session_unregister('cus_number');
        session_unregister('cus_village');
        session_unregister('cus_room');
        session_unregister('cus_floor');
        session_unregister('cus_alley');
        session_unregister('cus_alleyway');
        session_unregister('cus_road');
        session_unregister('cus_vilno');
        session_unregister('cus_district');
        session_unregister('cus_canton');
        session_unregister('cus_province');
        session_unregister('cus_post');
        session_unregister('cus_tel');
        session_unregister('cus_fax');
        session_unregister('cus_email');
        session_unregister('rg_branch');
        session_unregister('re_place_type');
        session_unregister('re_place_other');
        session_unregister('re_place_name');
        session_unregister('re_place_homeid');
        session_unregister('re_place_number');
        session_unregister('re_place_village');
        session_unregister('re_place_room');
        session_unregister('re_place_floor');
        session_unregister('re_place_alley');
        session_unregister('re_place_alleyway');
        session_unregister('re_place_road');
        session_unregister('re_place_vilno');
        session_unregister('re_place_district');
        session_unregister('re_place_canton');
        session_unregister('re_place_province');
        session_unregister('re_place_post');
        session_unregister('re_place_tel');
        session_unregister('re_place_fax');
        session_unregister('re_place_email');
        session_unregister('re_place_service');
        session_unregister('re_contact_place');
        session_unregister('re_contact_homeid');
        session_unregister('re_contact_number');
        session_unregister('re_contact_village');
        session_unregister('re_contact_room');
        session_unregister('re_contact_floor');
        session_unregister('re_contact_alley');
        session_unregister('re_contact_alleyway');
        session_unregister('re_contact_road');
        session_unregister('re_contact_villno');
        session_unregister('re_contact_district');
        session_unregister('re_contact_canton');
        session_unregister('re_contact_province');
        session_unregister('re_contact_post');
        session_unregister('re_contact_tel');
        session_unregister('re_contact_fax');
        session_unregister('re_contact_email');
        session_unregister('re_want_type');
        session_unregister('re_detail');
        session_unregister('re_want_other');
        session_unregister('re_use_type');
        session_unregister('re_use_other');
        session_unregister('re_dateset');

        session_unregister('re_keep_type');
        session_unregister('re_place_name');
        session_unregister('re_keep_homeid');
        session_unregister('re_keep_number');
        session_unregister('re_keep_village');
        session_unregister('re_keep_room');
        session_unregister('re_keep_floor');
        session_unregister('re_keep_alley');
        session_unregister('re_keep_alleyway');
        session_unregister('re_keep_road');
        session_unregister('re_keep_villno');
        session_unregister('re_keep_district');
        session_unregister('re_keep_canton');
        session_unregister('re_keep_province');
        session_unregister('re_keep_post');
        session_unregister('re_keep_tel');
        session_unregister('re_keep_fax');
        session_unregister('re_keep_email');
        session_unregister('file');		
?>