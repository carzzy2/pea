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
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body OnClick="window.print();" title="คลิกเพื่อปริ้นเอกสารนี้">
<?php
$sql_print="select * from  tb_general,tb_user,tb_customer where rg_id='".$_GET[rg_id]."' and tb_general.user_id=tb_user.user_id and tb_general.cus_id=tb_customer.cus_id  ";
$result_print=mysql_db_query($dbname,$sql_print);
$array_print=mysql_fetch_array($result_print);
if($array_print[rg_place_type]=="0"){
    $rg_place_type="เอกชน";
}elseif($array_print[rg_place_type]=="1"){
   $rg_place_type="ราชการ"; 
}elseif($array_print[rg_place_type]=="2"){
   $rg_place_type="รัฐวิสาหกิจ";  
}else{
    $rg_place_type=$array_print[rg_place_other]; 
}

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
                        เลขที่คำร้อง <?=$array_print[rg_id]?><br>
                        กฟฟ. <?=$array_print[rg_branch]?><br>
                        ผู้รับคำร้อง <?=$array_print[user_name]?> <?=$array_print[user_last]?><br>
                        วันที่ <?= Dateim($array_print[rg_date]);?>
                    </td>
		</tr>
		<tr>
                    <td valign="top" colspan="4" style="padding-top:7px;">
                        <b>1.ชื่อผู้ใช้ไฟฟ้า/ลูกค้า</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$array_print[cus_name]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ประเภทบัตร:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$array_print[cus_type]?>
                        <br>
                        เลขที่ <?=$array_print[cus_id]?>&nbsp;&nbsp;&nbsp;&nbsp;หมายเลขประจำตัวผู้เสียภาษีอากร:&nbsp;<?=$array_print[cus_tax]?> หมายเลขบัตร
                        <br>
                        <b>ที่อยู่</b> รหัสบ้าน: <?=$array_print[cus_homeid]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่:&nbsp;&nbsp;<?=$array_print[cus_number]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่บ้าน/อาคาร:&nbsp;&nbsp;<?=$array_print[cus_village]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ห้อง:&nbsp;&nbsp;<?=$array_print[cus_room]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชั้น: &nbsp;&nbsp;<?=$array_print[cus_floor]?>
                        <br>
                        ตรอก:&nbsp;&nbsp;<?=$array_print[cus_alley]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ซอย:&nbsp;&nbsp; <?=$array_print[cus_alleyway]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ถนน:&nbsp;&nbsp; <?=$array_print[cus_road]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่ที่:&nbsp;&nbsp; <?=$array_print[cus_vilno]?>
                        <br>
                        ตำบล:&nbsp;&nbsp;<?=$array_print[cus_district]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        อำเภอ:&nbsp;&nbsp; <?=$array_print[cus_canton]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        จังหวัด:&nbsp;&nbsp; <?=$array_print[cus_province]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        รหัสไปรษณีย์:&nbsp;&nbsp; <?=$array_print[cus_post]?>
                        <br>
                        โทรศัพท์:&nbsp;&nbsp;<?=$array_print[cus_tel]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        โทรสาร:&nbsp;&nbsp; <?=$array_print[cus_fax]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        E-mail:&nbsp;&nbsp; <?=$array_print[cus_email]?>
                    </td>
                </tr>
                <tr>
                    <td valign="top" colspan="4" style="padding-top:7px;">
                        <b>2.สถานที่ขอใช้บริการ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$rg_place_type?>
                        <br>
                        ชื่อสถานที่ใช้ไฟฟ้า:&nbsp;&nbsp; <?=$array_print[rg_place_name]?>
                        <br>
                        <b>ที่อยู่</b> รหัสบ้าน: <?=$array_print[rg_place_homeid]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่:&nbsp;&nbsp;<?=$array_print[rg_place_number]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่บ้าน/อาคาร:&nbsp;&nbsp;<?=$array_print[rg_place_village]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ห้อง:&nbsp;&nbsp;<?=$array_print[rg_place_room]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชั้น: &nbsp;&nbsp;<?=$array_print[rg_place_floor]?>
                        <br>
                        ตรอก:&nbsp;&nbsp;<?=$array_print[rg_place_alley]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ซอย:&nbsp;&nbsp; <?=$array_print[rg_place_alleyway]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ถนน:&nbsp;&nbsp; <?=$array_print[rg_place_road]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่ที่:&nbsp;&nbsp; <?=$array_print[rg_place_vilno]?>
                        <br>
                        ตำบล:&nbsp;&nbsp;<?=$array_print[rg_place_district]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        อำเภอ:&nbsp;&nbsp; <?=$array_print[rg_place_canton]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        จังหวัด:&nbsp;&nbsp; <?=$array_print[rg_place_province]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        รหัสไปรษณีย์:&nbsp;&nbsp; <?=$array_print[rg_place_post]?>
                        <br>
                        โทรศัพท์:&nbsp;&nbsp;<?=$array_print[rg_place_tel]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        โทรสาร:&nbsp;&nbsp; <?=$array_print[rg_place_fax]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        E-mail:&nbsp;&nbsp; <?=$array_print[rg_place_email]?>
                        <br>
                        ประเภทกิจการ:&nbsp;&nbsp;<?=$array_print[rg_place_service]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
                    <td valign="top" colspan="4" style="padding-top:7px;">
                        <b>3.สถานที่ติดต่อ/ที่อยู่ในการจัดส่งเอกสาร</b>
                        <br>
                        ติดต่อ&nbsp;&nbsp; <?=$array_print[rg_contact_place]?>
                        <br>
                        <b>ที่อยู่</b> รหัสบ้าน: <?=$array_print[rg_contact_homeid]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่:&nbsp;&nbsp;<?=$array_print[cus_number]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่บ้าน/อาคาร:&nbsp;&nbsp;<?=$array_print[rg_contact_village]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ห้อง:&nbsp;&nbsp;<?=$array_print[cus_room]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชั้น: &nbsp;&nbsp;<?=$array_print[cus_floor]?>
                        <br>
                        ตรอก:&nbsp;&nbsp;<?=$array_print[rg_contact_alley]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ซอย:&nbsp;&nbsp; <?=$array_print[rg_contact_alleyway]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ถนน:&nbsp;&nbsp; <?=$array_print[rg_contact_road]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่ที่:&nbsp;&nbsp; <?=$array_print[rg_contact_vilno]?>
                        <br>
                        ตำบล:&nbsp;&nbsp;<?=$array_print[rg_contact_district]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        อำเภอ:&nbsp;&nbsp; <?=$array_print[rg_contact_canton]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        จังหวัด:&nbsp;&nbsp; <?=$array_print[rg_contact_province]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        รหัสไปรษณีย์:&nbsp;&nbsp; <?=$array_print[rg_contact_post]?>
                        <br>
                        โทรศัพท์:&nbsp;&nbsp;<?=$array_print[rg_contact_tel]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        โทรสาร:&nbsp;&nbsp; <?=$array_print[rg_contact_fax]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        E-mail:&nbsp;&nbsp; <?=$array_print[rg_contact_email]?>
                    </td>
                </tr>
                <tr>
                    <td valign="top" colspan="4" style="padding-top:7px;">
                        <table border="0" width="800px">
                            <tr>
                                <td colspan="4" >
                                  <b>4.มีความประสงค์ ดังนี้</b>  
                                </td>
                            </tr>
                            <tr>
                                <td width="70px">
                                   &nbsp;&nbsp;&nbsp;&nbsp;
                                   <?php if($array_print[rg_want_type]=="0"){echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอรับเงินประกันการใช้ไฟฟ้าคืน</td>
                                <td width="70px" align="center">
                                   <?php if($array_print[rg_want_type]=="6"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอเช่าพื้นที่โฆษณา</td>
                            </tr>
                            <tr>
                                <td width="70px">
                                   &nbsp;&nbsp;&nbsp;&nbsp;
                                   <?php if($array_print[rg_want_type]=="1"){echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอรับเงินประกันคาปาซิเตอร์คืน</td>
                                <td width="70px" align="center">
                                   <?php if($array_print[rg_want_type]=="7"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอเช่าพาดสายโทรคมนาคม</td>
                            </tr>
                            <tr>
                                <td width="70px">
                                   &nbsp;&nbsp;&nbsp;&nbsp;
                                   <?php if($array_print[rg_want_type]=="2"){echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอรับเงินประกันหม้อแปลงไฟฟ้าคืน</td>
                                <td width="70px" align="center">
                                   <?php if($array_print[rg_want_type]=="8"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอเช่าสาย fiber optic</td>
                            </tr>
                            <tr>
                                <td width="70px">
                                   &nbsp;&nbsp;&nbsp;&nbsp;
                                   <?php if($array_print[rg_want_type]=="3"){echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอรับค่าขยายเขตระบบจำหน่ายไฟฟ้าคืน</td>
                                <td width="70px" align="center">
                                   <?php if($array_print[rg_want_type]=="9"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอเช่าที่ดิน</td>
                            </tr>
                            <tr>
                                <td width="70px">
                                   &nbsp;&nbsp;&nbsp;&nbsp;
                                   <?php if($array_print[rg_want_type]=="4"){echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอใช้บริการพิมพ์โฆษณาหลังใบแจ้งหนี้/ใบเสร็จรับเงิน</td>
                                <td width="70px" align="center">
                                   <?php if($array_print[rg_want_type]=="10"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอซื้อที่ดิน</td>
                            </tr>
                            <tr>
                                <td width="70px">
                                   &nbsp;&nbsp;&nbsp;&nbsp;
                                   <?php if($array_print[rg_want_type]=="5"){echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอชำระเงินค่าไฟฟ้าโดยหักจากบัญชีเงินฝากธนาคาร</td>
                                <td width="70px" align="center">
                                   <?php if($array_print[rg_want_type]=="11"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอใช้ไฟฟ้าที่ กฟภ. สนับสนุน</td>
                            </tr>
                            <tr>
                                <td width="70px">
                                   &nbsp;&nbsp;&nbsp;&nbsp;
                                   <?php if($array_print[rg_want_type]=="12"){echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td colspan="3">
                                    อื่นๆ <?php $array_print[rg_want_other]?>
                                </td>
                            </tr>
                            <tr>
                                <td width="70px" colspan="4">
                                    <b>รายละเอียดเพื่มเติม</b><?php $array_print[rg_detail]?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
	</table>
        <table width="100%" border="1" align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
            <tr>
                <td valign="top" colspan="4" style="padding-top:7px;">
                        <b>5.ข้อยินยอมของผู้ขอใช้บริการ</b>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ข้าพเจ้า ยินยอมปฎิบัติตามระเบียบและการบริการของการไฟฟ้าส่วนภูมิภาคทุกประการ
                        <br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        (ลงชื่อ)............................................<br>
                        
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ตำแหน่ง.........................................(ผู้ใช้ไฟฟ้า/ลูกค้า/ผู้รับมอบอำนาจ)
                </td>
            </tr>
        </table>
</body>
</html>
