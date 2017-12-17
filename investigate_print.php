<?php
session_start();

include "connect_db.php";
require_once('mpdf/mpdf.php');

function Dateim($mydate){
    $d=split("-",$mydate);
    $mydate=$d[2]."/".$d[1]."/".($d[0]+543);
    return "$mydate";
}
?>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
        <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet"><!-- Bootstrap Core CSS -->

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body OnClick="window.print();" title="คลิกเพื่อปริ้นเอกสารนี้">
<?php
$sql_print="select * from tb_investigate,tb_electricity,tb_user where ig_id='".$_GET[id]."' and tb_electricity.re_id=tb_investigate.re_id and tb_investigate.user_id=tb_user.user_id ";
$result_print=mysql_db_query($dbname,$sql_print);
$array_print=mysql_fetch_array($result_print);

?>
	<br>
        <table width="100%" border="1" align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
		<tr >
                    <td width="70px" style="border-right-color: white;">
                        <img  src="img/lo.png" width="70" >
                    </td>
                    <td valign="top" align="center"  width="350px" style="padding-top:7px;">
                        <b>การไฟฟ้าส่วนภูมิภาค<br>
                        200 ถนนงามวงส์วาน จตุจักร กรุงเทพฯ 10900<br>
                        คำร้องขอทั่วไป</b>
                    </td>
                    <td valign="top" style="padding-top:7px;" colspan="2">
                        เลขที่คำร้อง <?=$array_print[re_id]?><br>
                        กฟฟ. <?=$array_print[re_branch]?><br>
                        ผู้รับคำร้อง <?=$array_print[user_name]?> <?=$array_print[user_last]?><br>
                        วันที่ <?= Dateim($array_print[re_date]);?>
                    </td>
		</tr>
		<tr>
                    <td valign="top" colspan="4" style="padding-top:10px; line-height: 20pt ">
                        <b>&nbsp;รายงานและความเห็นของผู้ตรวจสอบ</b>
                        <br>
                        &nbsp;&nbsp;1.สายแม่แรงต่ำขนาด <?=$array_print[ig_lowtension]?> ตร.มม จำนวน <?=$array_print[ig_lowtension_amount]?> เฟส <?=$array_print[ig_lowtension_line]?> สาย<br>
                        &nbsp;&nbsp;2.จ่ายไฟจากสถานไฟฟ้าย่อย <?=$array_print[ig_power]?> ฟีดเดอร์สูง <?=$array_print[ig_power_speed]?> ปีจัดซื้อ(ตาม มป.5) <?=$array_print[ig_power_year]?><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<label><input size="30" type="checkbox"  <?php if($array_print[ig_lowpower]=="1"){ echo "checked";} ?> disabled>ฟิดเดอร์แรงต่ำ</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<label><input size="30" type="checkbox"  <?php if($array_print[ig_lowpower]=="2"){ echo "checked";} ?> disabled>เฟสแรงต่ำ</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspชนิดของหม้อแปลง <?=$array_print[ig_lowpower_type]?> หมายเลขหม้อแปลง <?=$array_print[ig_lowpower_number]?> หม้อแปลงขนาด <?=$array_print[ig_outlet]?><br>
                        &nbsp;&nbsp;3. ความเห็นของผู้ตรวจสอบ  ประเภทกิจการ <?=$array_print[ig_bstype]?><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspติดตั้งมิเตอร์ขนาด <?=$array_print[ig_meter]?> แอมป์ <?=$array_print[ig_meter_phase]?> เฟส <?=$array_print[ig_meter_volt]?> โวลท์<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspสายคิดต่าไฟฟ้าประเภท <?=$array_print[ig_linetype]?> แรงดัน <?=$array_print[ig_linetype_pressure]?> โวล์ <?=$array_print[ig_linetype_volt]?><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspติดตั้งซีทีขนาด <?=$array_print[ig_ct]?> วีทีขนาด <?=$array_print[ig_vt]?> เควาร์ขนาด <?=$array_print[ig_kwa]?><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspหมายเลข PEA. มิเตอร์ก่อนหน้า(สายการจดหน่วยเดียวกัน) <?=$array_print[ig_number_bf]?><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspหมายเลข PEA. มิเตอร์ถัดไป(สายการจดหน่วยเดียวกัน) <?=$array_print[ig_number_af]?><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspสายการจดหน่วย <?=$array_print[ig_linepoint]?> หมายเลข PEA.มิเตอร์ <?=$array_print[ig_linenumber]?><br>
                        &nbsp;&nbsp;การเดินสายและการติดตั้งอุปกรณ์ไฟฟ้า<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<label><input size="30" type="checkbox"  <?php if($array_print[ig_install]=="1"){ echo "checked";} ?> disabled>เรียบร้อยถูกต้องตามมาตรฐาน</label><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<label><input size="30" type="checkbox"  <?php if($array_print[ig_install]=="2"){ echo "checked";} ?> disabled>ไม่เรียบร้อย ควรแก้ไขเนื่องจาก 
                        <?php if($array_print[ig_install]=="2"){ echo $array_print[ig_install_other]; }else{echo "-";} ?></label><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<label><input size="30" type="checkbox"  <?php if($array_print[ig_install]=="3"){ echo "checked";} ?> disabled>นัดตรวจสอบใหม่วันที่ 
                         <?php if($array_print[ig_install]=="3"){ echo $array_print[ig_install_other]; }else{echo "-";} ?></label>
                        <br><br><br>
                        <center>
                        (ลงชื่อ).................................................. <br>
                        (...........................................................)<br>
                        ........../............../............ผู้ตรวจสอบ
                        </center>
                    </td>
                </tr>
	</table>
        
</body>
</html>
