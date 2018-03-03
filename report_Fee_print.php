<?php
session_start();
ob_start();
include "connect_db.php";
require_once('mpdf/mpdf.php');

function Dateim($mydate) {
    $d = split("-", $mydate);
    $mydate = $d[2] . "/" . $d[1] . "/" . ($d[0] + 543);
    return "$mydate";
}
function DateThai($date) {
    $strYear = date("Y", strtotime($date)) + 543;
    $strMonth = date("n", strtotime($date));
    $strDay = date("j", strtotime($date));
    $thaiweek = date("w", strtotime($date));
    $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    $thaiweekCut = array("วัน อาทิตย์", "วัน จันทร์", "วัน อังคาร", "วัน พุธ", "วัน พฤหัส", "วัน ศุกร์", "วัน เสาร์");
    $strweekThai = $thaiweekCut[$thaiweek];
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
        <table width="100%" align="center"  style=" border-collapse:inherit; border:1px ; line-height: 20px; font-size: 13px;">
            <tr>
                <td ><p><b>ตั้งแต่ :</b> <?= DateThai($_GET[date1]); ?> ถึง : <?= DateThai($_GET[date2]); ?></p></td>
            </tr>
        </table>
        <table width="100%" align="center" border="1"  style=" border-collapse:inherit; border:1px ; line-height: 20px; font-size: 13px;">
            <tr>
                <td colspan="2" width="70px" style="border-right-color: white;">
            <center><img  src="img/lo.png" width="70px" ></center>
                </td>
                <td valign="top" colspan="5" align="center"  width="350px" style="padding-top:7px; ">
                    <b>การไฟฟ้าส่วนภูมิภาค<br>
                        200 ถนนงามวงส์วาน จตุจักร กรุงเทพฯ 10900<br>
                        </b>
                </td>
            </tr>
            <tr >
                <td colspan="7" align="center" style="background-color:#337ab7; color: #fff; padding-top:7px;" >
                    <h3>รายงานรับชำระค่าธรรมเนียม</h3>
                </td>
            </tr>
            <tr>
                <td style="padding-top:7px;" align="center" width="50px"><b>ลำดับ</b></td>
                <td style="padding-top:7px;" align="center" width="125px"><b>รหัสชำระเงิน</b></td>
                <td style="padding-top:7px;" align="center" width="125px"><b>วันที่ชำระ</b></td>
                <td style="padding-top:7px;" align="center" width="125px"><b>ประเภท</b></td>
                <td style="padding-top:7px;" align="center" width="125px"><b>รหัส</b></td>
                <td style="padding-top:7px;"  align="center"><b>รายการ</b></td>
                <td style="padding-top:7px;"  align="center" width="125px"><b>จำนวนเงิน</b></td>
            </tr>
                <?php
                if ($_GET['status'] == "0") {
                    $where = "and rg_id<>''";
                } elseif ($_GET['status'] == "1") {
                    $where = "and re_id<>''";
                } else {
                    $where="";
                }
                $sql = "select * from tb_fee,tb_user where fee_date between '".$_GET[date1]."' and '".$_GET[date2]."' $where and  tb_fee.user_id=tb_user.user_id  ";
                $result = mysql_db_query($dbname, $sql);
                $num = mysql_num_rows($result);
                if (mysql_num_rows($result) > 0) {
                    while ($array = mysql_fetch_array($result)) {
                        $page++;
                        if ($array[re_id] != "") {
                            $sql2 = "select * from tb_electricity where re_id='$array[re_id]' ";
                            $result2 = mysql_db_query($dbname, $sql2);
                            $array2 = mysql_fetch_array($result2);
                            $ss_id = $array[re_id];
                        if ($array2[re_want_type] == 0) {
                            $want = "ขอติดตั้งมิเตอร์ใหม่";
                        } elseif ($array2[re_want_type] == 1) {
                            $want = "ขอตัดฝากมิเตอร์โดยไม่ใช้ไฟฟ้า";
                        } elseif ($array2[re_want_type] == 2) {
                            $want = "ขอต่อกลับการใช้ไฟฟ้า";
                        } elseif ($array2[re_want_type] == 3) {
                            $want = "ขอเพื่มขนาดมิเตอร์/อุปกรณ์ประกอบ";
                        } elseif ($array2[re_want_type] == 4) {
                            $want = "ขอเปลี่ยนประเภทมิเตอร์";
                        } elseif ($array2[re_want_type] == 5) {
                            $want = "ขอหยุดซ่อมแซมเครื่องจักรประจำปี";
                        } elseif ($array2[re_want_type] == 6) {
                            $want = "ขอใช้ไฟฟ้าชั่วคราวแบบเหมาจ่าย";
                        } elseif ($array2[re_want_type] == 7) {
                            $want = "ขอติดตั้งไฟฟ้าชั่วคราว";
                        } elseif ($array2[re_want_type] == 8) {
                            $want = "ขอตัดฝากมิเตอร์ใช้เพื่อแสงสว่างไม่ลด CT";
                        } elseif ($array2[re_want_type] == 9) {
                            $want = "ขอยกเลิกเลิกการใช้ไฟฟ้า";
                        } elseif ($array2[re_want_type] == 10) {
                            $want = "ชอลดขนาดมิเตอร์/อุปกรณ์ประกอบ";
                        } elseif ($array2[re_want_type] == 11) {
                            $want = "ขอใช้ไฟฟ้าสาธารณะ";
                        } elseif ($array2[re_want_type] == 12) {
                            $want = "ขอตัดมิเตอร์ใช้เพื่อแสงสว่างลด CT";
                        } elseif ($array2[re_want_type] == 13) {
                            $want = "ขอย้ายจุดติดตั้งมิเตอร์/อุปกรณ์ประกอบ";
                        } elseif ($array2[re_want_type] == 14) {
                            $want = "ขอเปลี่ยนมิเตอร์กรณีชำรุด";
                        } elseif ($array2[re_want_type] == 15) {
                            $want = "ขอใช้ไฟฟ้าตู้โทรศัพท์ต่อตรง";
                        } elseif ($array2[re_want_type] == 16) {
                            $want = $array2[re_place_other];
                        }
                        $type = "คำร้องขอใช้ไฟฟ้า";
                        $link = "fee_detail";
                    } else {
                        $sql2 = "select * from tb_general where rg_id='$array[rg_id]' ";
                        $result2 = mysql_db_query($dbname, $sql2);
                        $array2 = mysql_fetch_array($result2);
                        $ss_id = $array[rg_id];
                        $type = "คำร้องทั่วไป";
                        $link = "fee_detail2";
                        if ($array2[rg_want_type] == 0) {
                            $want = "ขอรับเงินประกันการใช้ไฟฟ้าคืน";
                        } elseif ($array2[rg_want_type] == 1) {
                            $want = "ขอรับเงินประกันคาปาซิเตอร์คืน";
                        } elseif ($array2[rg_want_type] == 2) {
                            $want = "ขอรับเงินประกันหม้อแปลงไฟฟ้าคืน";
                        } elseif ($array2[rg_want_type] == 3) {
                            $want = "ขอรับค่าขยายเขตระบบจำหน่ายไฟฟ้าคืน";
                        } elseif ($array2[rg_want_type] == 4) {
                            $want = "ขอใช้บริการพิมพ์โฆษณาหลังใบแจ้งหนี้";
                        } elseif ($array2[rg_want_type] == 5) {
                            $want = "ขอชำระเงินค่าไฟฟ้าโดยหักจากบัญชีเงินฝากธนาคาร";
                        } elseif ($array2[rg_want_type] == 6) {
                            $want = "ขอเช่าพื้นที่โฆษณา";
                        } elseif ($array2[rg_want_type] == 7) {
                            $want = "ขอเช่าพาดสายโทรนาคม";
                        } elseif ($array2[rg_want_type] == 8) {
                            $want = "ขอเช่าสาย fiber optic";
                        } elseif ($array2[rg_want_type] == 9) {
                            $want = "ขอเช่าที่ดิน";
                        } elseif ($array2[rg_want_type] == 10) {
                            $want = "ขอซื้อที่ดิน";
                        } elseif ($array2[rg_want_type] == 11) {
                            $want = "ขอใช้ไฟฟ้าที่ กฟภ. สนับสนุน";
                        } else {
                            $want = $array[rg_want_other];
                        }
                        
                    }
                    $summoney+= $array[fee_price];
                        ?>	
                        <tr>
                            <td style="padding-top:7px;" align="center"><?= $page ?></td>
                            <td  style="padding-top:7px;" align="center"><?= $array[fee_id] ?></td>
                            <td  style="padding-top:7px;" align="center"><?= Dateim($array[fee_date]); ?></td>
                            <td  style="padding-top:7px;" align="center"><?= $type ?></td>
                            <td style="padding-top:7px;" align="center"><?=$ss_id?></td>
                            <td style="padding-top:7px;" ><?= $want ?></td>
                            <td style="padding-top:7px; padding-right:7px;" align="right"><?= number_format($array[fee_price],2) ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td style="padding-top:7px; padding-right:7px;" colspan="4" align="right"><b>รวมทั้งสิ้น</b></td>
                        <td style="padding-top:7px; padding-right:7px;" align="right"><?= $num ?> รายการ</td>
                        <td style="padding-top:7px; padding-right:7px;"  align="right"><b>เป็นเงิน</b></td>
                        <td style="padding-top:7px; padding-right:7px;" align="right"><?= number_format($summoney, 2) ?></td>
                    </tr>
                    <?php
                } else {
                    ?>				  
                    <tr><td colspan="7" style="padding-top:8px; color: red;" align="center">ไม่พบข้อมูล</td></tr>
                    <?php
                }
                ?>
        </table>
    </body>
</html>
<?Php
$html = ob_get_contents();
ob_end_clean();

$pdf = new mPDF('td', 'A4-L', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetLeftMargin(0);
$pdf->SetTopMargin(10);
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>