<?php
@session_start();
include "connect_db.php";
if($_GET[mode]=="RequestElectricity_part1"){
	if($_GET[id]==""){
                $_SESSION['rg_branch']=$_POST[rg_branch];
		$_SESSION['cus_first']=$_POST[cus_first];
		$_SESSION['cus_name']=$_POST[cus_name];
		$_SESSION['cus_type']=$_POST[cus_type];
		$_SESSION['cus_id']=$_POST[cus_id];
		$_SESSION['cus_tax']=$_POST[cus_tax];
		$_SESSION['cus_code']=$_POST[cus_code];
		$_SESSION['cus_homeid']=$_POST[cus_homeid];
		$_SESSION['cus_number']=$_POST[cus_number];
		$_SESSION['cus_village']=$_POST[cus_village];
		$_SESSION['cus_room']=$_POST[cus_room];
		$_SESSION['cus_floor']=$_POST[cus_floor];
		$_SESSION['cus_alley']=$_POST[cus_alley];
		$_SESSION['cus_alleyway']=$_POST[cus_alleyway];	
		$_SESSION['cus_road']=$_POST[cus_road];
		$_SESSION['cus_vilno']=$_POST[cus_vilno];
		$_SESSION['cus_district']=$_POST[cus_district];
		$_SESSION['cus_canton']=$_POST[cus_canton];
		$_SESSION['cus_province']=$_POST[cus_province];
		$_SESSION['cus_post']=$_POST[cus_post];
		$_SESSION['cus_tel']=$_POST[cus_tel];		
		$_SESSION['cus_fax']=$_POST[cus_fax];	
		$_SESSION['cus_email']=$_POST[cus_email];	
	}else{
		$_SESSION['cus_id']=$_GET[id];
                    $sql="select * from tb_customer where cus_id='".$_GET[id]."'";
                    $result=mysql_db_query($dbname,$sql);
                    $array=mysql_fetch_array($result);
                    
                    $_SESSION['cus_id']=$array[cus_id];
                    $_SESSION['cus_first']=$array[cus_first];
                    $_SESSION['cus_name']=$array[cus_name];
                    $_SESSION['cus_type']=$array[cus_type];
                    $_SESSION['cus_tax']=$array[cus_tax];
                    $_SESSION['cus_code']=$array[cus_code];

                    $_SESSION['cus_homeid']=$array[cus_homeid];
                    $_SESSION['cus_number']=$array[cus_number];
                    $_SESSION['cus_village']=$array[cus_village];
                    $_SESSION['cus_room']=$array[cus_room];
                    $_SESSION['cus_floor']=$array[cus_floor];
                    $_SESSION['cus_alley']=$array[cus_alley];
                    $_SESSION['cus_alleyway']=$array[cus_alleyway];
                    $_SESSION['cus_road']=$array[cus_road];
                    $_SESSION['cus_vilno']=$array[cus_vilno];
                    $_SESSION['cus_district']=$array[cus_district];
                    $_SESSION['cus_canton']=$array[cus_canton];
                    $_SESSION['cus_province']=$array[cus_province];
                    $_SESSION['cus_post']=$array[cus_post];
                    $_SESSION['cus_tel']=$array[cus_tel];
                    $_SESSION['cus_fax']=$array[cus_fax];
                    $_SESSION['cus_road']=$array[cus_road];
                    $_SESSION['cus_email']=$array[cus_email];
	}
	echo "<meta http-equiv='refresh' content='0;URL=RequestElectricity_part2.php'>";
}elseif($_GET[mode]=="RequestElectricity_part2"){
		$_SESSION['rg_branch']=$_POST[rg_branch];
		$_SESSION['re_place_type']=$_POST[re_place_type];
		$_SESSION['re_place_other']=$_POST[re_place_other];
		$_SESSION['re_place_name']=$_POST[re_place_name];
		$_SESSION['re_place_homeid']=$_POST[re_place_homeid];
		$_SESSION['re_place_number']=$_POST[re_place_number];
		$_SESSION['re_place_village']=$_POST[re_place_village];
		$_SESSION['re_place_room']=$_POST[re_place_room];
		$_SESSION['re_place_floor']=$_POST[re_place_floor];
		$_SESSION['re_place_alley']=$_POST[re_place_alley];
		$_SESSION['re_place_alleyway']=$_POST[re_place_alleyway];
		$_SESSION['re_place_road']=$_POST[re_place_road];
		$_SESSION['re_place_vilno']=$_POST[re_place_vilno];
		$_SESSION['re_place_district']=$_POST[re_place_district];
		$_SESSION['re_place_canton']=$_POST[re_place_canton];	
		$_SESSION['re_place_province']=$_POST[re_place_province];
		$_SESSION['re_place_post']=$_POST[re_place_post];
		$_SESSION['re_place_tel']=$_POST[re_place_tel];
		$_SESSION['re_place_fax']=$_POST[re_place_fax];
		$_SESSION['re_place_email']=$_POST[re_place_email];
		$_SESSION['re_place_service']=$_POST[re_place_service];	
	echo "<meta http-equiv='refresh' content='0;URL=RequestElectricity_part3.php'>";
}elseif($_GET[mode]=="RequestElectricity_part3"){
		$_SESSION['re_contact_place']=$_POST[re_contact_place];
		$_SESSION['re_contact_homeid']=$_POST[re_contact_homeid];
		$_SESSION['re_contact_number']=$_POST[re_contact_number];
		$_SESSION['re_contact_village']=$_POST[re_contact_village];
		$_SESSION['re_contact_room']=$_POST[re_contact_room];
		$_SESSION['re_contact_floor']=$_POST[re_contact_floor];
		$_SESSION['re_contact_alley']=$_POST[re_contact_alley];
		$_SESSION['re_contact_alleyway']=$_POST[re_contact_alleyway];
		$_SESSION['re_contact_road']=$_POST[re_contact_road];
		$_SESSION['re_contact_villno']=$_POST[re_contact_villno];
		$_SESSION['re_contact_district']=$_POST[re_contact_district];
		$_SESSION['re_contact_canton']=$_POST[re_contact_canton];
		$_SESSION['re_contact_province']=$_POST[re_contact_province];	
		$_SESSION['re_contact_post']=$_POST[re_contact_post];
		$_SESSION['re_contact_tel']=$_POST[re_contact_tel];
		$_SESSION['re_contact_fax']=$_POST[re_contact_fax];
		$_SESSION['re_contact_email']=$_POST[re_contact_email];
	echo "<meta http-equiv='refresh' content='0;URL=RequestElectricity_part4.php'>";
}elseif($_GET[mode]=="RequestElectricity_part4"){
		$_SESSION['re_want_type']=$_POST[re_want_type];
		$_SESSION['re_detail']=$_POST[re_detail];
		$_SESSION['re_want_other']=$_POST[re_want_other];
	echo "<meta http-equiv='refresh' content='0;URL=RequestElectricity_part5.php'>";
}elseif($_GET[mode]=="RequestElectricity_part5"){
		$_SESSION['re_use_type']=$_POST[re_use_type];
		$_SESSION['re_use_other']=$_POST[re_use_other];
	echo "<meta http-equiv='refresh' content='0;URL=RequestElectricity_part6.php'>";
}	
?>