<meta charset="utf-8">
<?php
@session_start();
include "connect_db.php";
mysql_query("SET NAMES UTF8");
$new_id = mysql_result(mysql_query("Select Max(substr(ig_id,-4))+1 as MaxID from tb_investigate"), 0, "MaxID");
if ($new_id == '') {
    $igid = "160000000001";
} else {
    $igid = "16" . sprintf("%010d", $new_id);
}
        
if ($_POST[ig_install] == "1") {
    $other = "-";
    $status="6";
} elseif($_POST[ig_install] == "2") {
    $other =$_POST[ig_install_other1];
    $status="4";
}
$sql = "update tb_electricity set re_status='".$status."' where re_id='" . $_POST[re_id] . "'";
mysql_query($sql);

$sql2 = "insert into tb_investigate(ig_id,ig_date,user_id,re_id,
ig_lowtension,ig_lowtension_amount,ig_lowtension_line,ig_power,
ig_power_speed,ig_power_year,ig_lowpower,ig_lowpower_type,ig_lowpower_number,ig_outlet,ig_bstype,ig_meter,ig_meter_phase,ig_meter_volt,ig_linetype,
ig_linetype_pressure,ig_linetype_volt,ig_ct,ig_vt,ig_kwa,ig_number_bf,ig_number_af,ig_linepoint,ig_linenumber,ig_install,ig_install_other) 
values('" . $igid . "',NOW(),'" . $_POST['user_id'] . "','" . $_POST[re_id] . "','" . $_POST[ig_lowtension] . "',
'" . $_POST[ig_lowtension_amount] . "','" . $_POST[ig_lowtension_line] . "','" . $_POST[ig_power] . "',
'" . $_POST[ig_power_speed] . "','" . $_POST[ig_power_year] . "','" . $_POST[ig_lowpower] . "','" . $_POST[ig_lowpower_type] . "',
'" . $_POST[ig_lowpower_number] . "','" . $_POST[ig_outlet] . "','" . $_POST[ig_bstype]."','" . $_POST[ig_meter]."','" . $_POST[ig_meter_phase]."',
'" . $_POST[ig_meter_volt]."', '" . $_POST[ig_linetype]."', '" . $_POST[ig_linetype_pressure]."','" . $_POST[ig_linetype_volt]."',
'" . $_POST[ig_ct]."','" . $_POST[ig_vt]."','" . $_POST[ig_kwa]."','" . $_POST[ig_number_bf]."','" . $_POST[ig_number_af]."',
'" . $_POST[ig_linepoint]."','" . $_POST[ig_linenumber]."','" . $_POST[ig_install]."','" . $other."')";
mysql_query($sql2);
echo "<script>alert('เรียบร้อยแล้ว');</script>";
echo "<META http-equiv='refresh' Content='0; URL=investigate_show.php'>";




?>