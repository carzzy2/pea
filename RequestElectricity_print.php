<?php
session_start();
ob_start();
include "connect_db.php";
require_once('mpdf/mpdf.php');

function Dateim($mydate){
    $d=split("-",$mydate);
    $mydate=$d[2]."/".$d[1]."/".($d[0]+543);
    return "$mydate";
}
function DateThai($date){
    $strYear = date("Y",strtotime($date))+543;
    $strMonth= date("n",strtotime($date));
    $strDay= date("j",strtotime($date));
    $thaiweek= date("w",strtotime($date));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    $thaiweekCut=array("วัน อาทิตย์","วัน จันทร์","วัน อังคาร","วัน พุธ","วัน พฤหัส","วัน ศุกร์","วัน เสาร์"); 
    $strweekThai=$thaiweekCut[$thaiweek];
    return "วันที่ $strDay เดือน $strMonthThai พ.ศ. $strYear";
}
?>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<?php
$sql_print="select * from  tb_electricity,tb_user,tb_customer where re_id='".$_GET[re_id]."' and tb_electricity.user_id=tb_user.user_id and tb_electricity.cus_id=tb_customer.cus_id  ";
$result_print=mysql_db_query($dbname,$sql_print);
$array_print=mysql_fetch_array($result_print);
if($array_print[re_place_type]=="0"){
    $re_place_type="เอกชน";
}elseif($array_print[re_place_type]=="1"){
   $re_place_type="ราชการ"; 
}else{
    $re_place_type=$array_print[re_place_other]; 
}
?>
	<br>
        <table width="100%" border="1" align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px; font-size: 13px;" >
		<tr >
                    <td width="70px" style="border-right-color: white;">
                        <img  src="img/lo.png" width="70" >
                    </td>
                    <td valign="top" align="center"  width="335px" style="padding-top:7px;">
                        <b>การไฟฟ้าส่วนภูมิภาค<br>
                        200 ถนนงามวงส์วาน จตุจักร กรุงเทพฯ 10900<br>
                        คำร้องขอใช้ไฟฟ้า</b>
                    </td>
                    <td valign="top" style="padding-top:7px;" colspan="2">
                        เลขที่คำร้อง <?=$array_print[re_id]?><br>
                        กฟฟ. <?=$array_print[re_branch]?><br>
                        ผู้รับคำร้อง <?=$array_print[user_name]?> <?=$array_print[user_last]?><br>
                        วันที่ <?= Dateim($array_print[re_date]);?>
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
                        <b>2.สถานที่ขอใช้บริการ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$re_place_type?>
                        <br>
                        ชื่อสถานที่ใช้ไฟฟ้า:&nbsp;&nbsp; <?=$array_print[re_place_name]?>
                        <br>
                        <b>ที่อยู่</b> รหัสบ้าน: <?=$array_print[re_place_homeid]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่:&nbsp;&nbsp;<?=$array_print[re_place_number]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่บ้าน/อาคาร:&nbsp;&nbsp;<?=$array_print[re_place_village]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ห้อง:&nbsp;&nbsp;<?=$array_print[re_place_room]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชั้น: &nbsp;&nbsp;<?=$array_print[re_place_floor]?>
                        <br>
                        ตรอก:&nbsp;&nbsp;<?=$array_print[re_place_alley]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ซอย:&nbsp;&nbsp; <?=$array_print[re_place_alleyway]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ถนน:&nbsp;&nbsp; <?=$array_print[re_place_road]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่ที่:&nbsp;&nbsp; <?=$array_print[re_place_vilno]?>
                        <br>
                        ตำบล:&nbsp;&nbsp;<?=$array_print[re_place_district]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        อำเภอ:&nbsp;&nbsp; <?=$array_print[re_place_canton]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        จังหวัด:&nbsp;&nbsp; <?=$array_print[re_place_province]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        รหัสไปรษณีย์:&nbsp;&nbsp; <?=$array_print[re_place_post]?>
                        <br>
                        โทรศัพท์:&nbsp;&nbsp;<?=$array_print[re_place_tel]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        โทรสาร:&nbsp;&nbsp; <?=$array_print[re_place_fax]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        E-mail:&nbsp;&nbsp; <?=$array_print[re_place_email]?>
                        <br>
                        ประเภทกิจการ:&nbsp;&nbsp;<?=$array_print[re_place_service]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
                    <td valign="top" colspan="4" style="padding-top:7px;">
                        <b>3.สถานที่ติดต่อ/ที่อยู่ในการจัดส่งเอกสาร</b>
                        <br>
                        ติดต่อ&nbsp;&nbsp; <?=$array_print[re_contact_place]?>
                        <br>
                        <b>ที่อยู่</b> รหัสบ้าน: <?=$array_print[re_contact_homeid]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่:&nbsp;&nbsp;<?=$array_print[cus_number]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่บ้าน/อาคาร:&nbsp;&nbsp;<?=$array_print[re_contact_village]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ห้อง:&nbsp;&nbsp;<?=$array_print[cus_room]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชั้น: &nbsp;&nbsp;<?=$array_print[cus_floor]?>
                        <br>
                        ตรอก:&nbsp;&nbsp;<?=$array_print[re_contact_alley]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ซอย:&nbsp;&nbsp; <?=$array_print[re_contact_alleyway]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ถนน:&nbsp;&nbsp; <?=$array_print[re_contact_road]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่ที่:&nbsp;&nbsp; <?=$array_print[re_contact_vilno]?>
                        <br>
                        ตำบล:&nbsp;&nbsp;<?=$array_print[re_contact_district]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        อำเภอ:&nbsp;&nbsp; <?=$array_print[re_contact_canton]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        จังหวัด:&nbsp;&nbsp; <?=$array_print[re_contact_province]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        รหัสไปรษณีย์:&nbsp;&nbsp; <?=$array_print[re_contact_post]?>
                        <br>
                        โทรศัพท์:&nbsp;&nbsp;<?=$array_print[re_contact_tel]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        โทรสาร:&nbsp;&nbsp; <?=$array_print[re_contact_fax]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        E-mail:&nbsp;&nbsp; <?=$array_print[re_contact_email]?>
                    </td>
                </tr>
                <tr>
                    <td valign="top" colspan="4" style="padding-top:7px;" >
                        <table border="0" width="800px" >
                            <tr>
                                <td colspan="6">
                                  <b>4.มีความประสงค์ ดังนี้</b>  
                                </td>
                            </tr>
                            <tr>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="0"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอติดตั้งมิเตอร์ใหม่</td>
                                <td width="35px" align="center">
                                   <?php if($array_print[re_want_type]=="6"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอใช้ไฟฟ้าชั่วคราวแบบเหมาจ่าย</td>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="11"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอใช้ไฟฟ้าสาธารณะ</td>
                            </tr>
                            <tr>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="1"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอตัดฝากมิเตอร์โดยไม่ใช้ไฟฟ้า</td>
                                <td width="35px" align="center">
                                   <?php if($array_print[re_want_type]=="7"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอติดตั้งไฟฟ้าชั่วคราว</td>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="12"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอตัดมิเตอร์ใช้เพื่อแสงสว่างลด CT</td>
                            </tr>
                            <tr>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="2"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอต่อกลับการใช้ไฟฟ้า</td>
                                <td width="35px" align="center">
                                   <?php if($array_print[re_want_type]=="8"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอตัดฝากมิเตอร์ใช้เพื่อแสงสว่างไม่ลด CT</td>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="13"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอย้ายจุดติดตั้งมิเตอร์/อุปกรณ์ประกอบ</td>
                            </tr>
                            <tr>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="3"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอเพื่มขนาดมิเตอร์/อุปกรณ์ประกอบ</td>
                                <td width="35px" align="center">
                                   <?php if($array_print[re_want_type]=="9"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอยกเลิกการใช้ไฟฟ้า</td>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="14"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอเปลี่ยนมิเตอร์กรณีชำรุด</td>
                            </tr>
                            <tr>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="4"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอเปลี่ยนประเภทมิเตอร์</td>
                                <td width="35px" align="center">
                                   <?php if($array_print[re_want_type]=="10"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอลดขนาดมิเตอร์/อุปกรณ์ประกอบ</td>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="15"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอใช้ไฟฟ้าตู้โทรศัพท์ต่อตรง</td>
                            </tr>
                            <tr>
                                <td width="35px">
                                   <?php if($array_print[re_want_type]=="5"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ขอหยุดซ่อมแซมเครื่องจักรประจำปี</td>
                                <td width="35px">
                                   &nbsp;<?php if($array_print[re_want_type]=="16"){echo "[&nbsp;&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td colspan="3">
                                    อื่นๆระบุ:
                                    <?php if($array_print[re_want_type]=="16"){echo $array_print[re_want_other];}else{echo "................................................................................................";}?>
                                </td>
                            </tr>
                            <tr>
                                <td width="35px" colspan="6">
                                    <b>รายละเอียดเพื่มเติม</b><br>
                                    <?php if($array_print[re_detail]!="-"){echo $array_print[re_detail];}else{echo ".........................................................................................................................................................................................";}?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
	</table>
        <table width="100%" border="1" align="center" style=" border-collapse:inherit; font-size: 13px;" >
                <tr>
                    <td valign="top" colspan="4" style="padding-top:7px;" >
                        <table border="0" width="100%" >
                            <tr>
                                <td colspan="8">
                                  <b>5.ประเภทการใช้ไฟฟ้า</b>  
                                </td>
                            </tr>
                            <tr>
                                <td width="35px">
                                   <?php if($array_print[re_use_type]=="0"){echo "[&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>บ้านที่อยู่อาศัย</td>
                                <td width="35px" align="center">
                                   <?php if($array_print[re_use_type]=="2"){echo "[&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>กิจการขนาดเล็ก</td>
                                <td width="35px">
                                   <?php if($array_print[re_use_type]=="4"){echo "[&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>กิจการขนาดกลาง</td>
                                <td width="35px">
                                   <?php if($array_print[re_use_type]=="6"){echo "[&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>กิจการขนาดใหญ่</td>
                            </tr>
                            <tr>
                                <td width="35px">
                                   <?php if($array_print[re_use_type]=="1"){echo "[&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>กิจการเฉพาะอย่าง</td>
                                <td width="35px" align="center">
                                   <?php if($array_print[re_use_type]=="3"){echo "[&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ราการ/องค์กรไม่แสวงหาผลกำไร</td>
                                <td width="35px">
                                   <?php if($array_print[re_use_type]=="5"){echo "[&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>สูบน้ำเพื่อการเกษตร</td>
                                <td width="35px">
                                   <?php if($array_print[re_use_type]=="7"){echo "[&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td>ไฟฟ้าชั่วคราว</td>
                            </tr>

                            <tr>
                                <td width="35px">
                                   <?php if($array_print[re_use_type]=="8"){echo "[&nbsp;<img src='img/check.png' width='15px' >]";}else{echo "[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;";}?>
                                </td>
                                <td colspan="7">
                                    อื่นๆระบุ: 
                                        <?php if($array_print[re_use_type]=="8"){echo $array_print[re_use_other];}else{echo "..............................................................................................................................................................";}?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
        </table>
        <table align="right" border="0" width="800">
            <tr>
                <td style="text-align: right;">
                    <b>ผู้ใช้ไฟฟ้า/ลูกค้าลงนาม</b> <input type="text" size="50" >
                </td>
            </tr>
        </table>
        <div style="display:block;height:1px; page-break-before:always;"></div>
        <table width="100%" border="1" align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px; font-size: 13px;" >
		<tr >
                    <td width="70px" style="border-right-color: white;">
                        <img  src="img/lo.png" width="70" >
                    </td>
                    <td valign="top" align="center"  width="335px" style="padding-top:7px;">
                        <b>การไฟฟ้าส่วนภูมิภาค<br>
                        200 ถนนงามวงส์วาน จตุจักร กรุงเทพฯ 10900<br>
                        คำร้องขอใช้ไฟฟ้า</b>
                    </td>
                    <td valign="top" style="padding-top:7px;" colspan="2">
                        เลขที่คำร้อง <?=$array_print[re_id]?><br>
                        กฟฟ. <?=$array_print[re_branch]?><br>
                        ผู้รับคำร้อง <?=$array_print[user_name]?> <?=$array_print[user_last]?><br>
                        วันที่ <?= Dateim($array_print[re_date]);?>
                    </td>
		</tr>
                <tr>
                    <td valign="top" colspan="4" style="padding-top:7px;">
                        <b>6.กำหนดการใช้ไฟฟ้า</b><?=DateThai($array_print[re_dateset])?>
                        <br>
                    </td>
                </tr>
                
                <tr>
                    <td valign="top" colspan="4" style="padding-top:7px;">
                        <b>7.ผู้ขอใช้ไฟฟ้ามีความประสงค์ที่จะชำระเงินค่าไฟฟ้าประจำเดือนด้วย</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if($array_print[re_keep_type]='0'){ echo "เงินสด";}else{ echo "หักจากบัญชีธนาคาร";}?>
                        <br>
                        ทั้งนี่ กฟภ.สามารถเรียกเก็บเงินค่ากระแสไฟฟ้าดังกล่าวได้จาก:&nbsp;&nbsp; <?=$array_print[re_keep_name]?>
                        <br>
                        <b>ที่อยู่</b> รหัสบ้าน: <?=$array_print[re_keep_homeid]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่:&nbsp;&nbsp;<?=$array_print[re_keep_number]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่บ้าน/อาคาร:&nbsp;&nbsp;<?=$array_print[re_keep_village]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ห้อง:&nbsp;&nbsp;<?=$array_print[re_keep_room]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชั้น: &nbsp;&nbsp;<?=$array_print[re_keep_floor]?>
                        <br>
                        ตรอก:&nbsp;&nbsp;<?=$array_print[re_keep_alley]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ซอย:&nbsp;&nbsp; <?=$array_print[re_keep_alleyway]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ถนน:&nbsp;&nbsp; <?=$array_print[re_keep_road]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมู่ที่:&nbsp;&nbsp; <?=$array_print[re_keep_vilno]?>
                        <br>
                        ตำบล:&nbsp;&nbsp;<?=$array_print[re_keep_district]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        อำเภอ:&nbsp;&nbsp; <?=$array_print[re_keep_canton]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        จังหวัด:&nbsp;&nbsp; <?=$array_print[re_keep_province]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        รหัสไปรษณีย์:&nbsp;&nbsp; <?=$array_print[re_keep_post]?>
                        <br>
                        โทรศัพท์:&nbsp;&nbsp;<?=$array_print[re_keep_tel]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        โทรสาร:&nbsp;&nbsp; <?=$array_print[re_keep_fax]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        E-mail:&nbsp;&nbsp; <?=$array_print[re_keep_email]?>
                    </td>
                </tr>
                <tr>
                    <td valign="top" colspan="4" >
                        <b>แผนที่สังเขปแสดงที่ตั้งสถานที่ใช้ไฟฟ้า</b><br><br>
                <center><img src="<?=$array_print[re_picture]?>" width="500" height="500"></center>
                    </td>
                </tr>
                
                
	</table>
</body>
</html>
<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>