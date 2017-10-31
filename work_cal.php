<?php
	session_start();
	include "connect_db.php";
	mysql_query("SET NAMES UTF8");
	$tdel=$HTTP_GET_VARS[tdel];
		for ($i=0;$i<count($_SESSION['ss_user_id']);$i++){
			if($tdel!=""){	
				if($tdel!=$_SESSION['ss_user_id'][$i]){
					$temt_id[]=$_SESSION['ss_user_id'][$i];
				}
			}
		
		}
	if($tdel!=""){	
		$_SESSION['ss_user_id']=$temt_id;
		$_SESSION['ss_user_detail']=$temt_num;
	}
	if($HTTP_POST_VARS[calculatertool]){	
		echo "<meta http-equiv='refresh' content = '0; URL =work_new.php'>";
	}elseif($tdel!=""){
		echo "<meta http-equiv='refresh' content = '0; URL =work_new.php'>";
	}elseif($HTTP_POST_VARS[finish]){	
		echo "<meta http-equiv='refresh' content = '0; URL =work_save.php'>";
	}else{
		echo "<meta http-equiv='refresh' content = '0; URL =work_new.php'>";
	}
?>