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
                <td valign="top" colspan="4" align="center"  width="350px" style="padding-top:7px; ">
                    <b>การไฟฟ้าส่วนภูมิภาค<br>
                        200 ถนนงามวงส์วาน จตุจักร กรุงเทพฯ 10900<br>
                        </b>
                </td>
            </tr>
            <tr >
                <td colspan="6" align="center" style="background-color:#337ab7; color: #fff; padding-top:7px;" >
                    <h3>รายงานบันทึกขอคืนเงิน</h3>
                </td>
            </tr>
            <tr>
                <td style="padding-top:7px;" align="center" width="50px"><b>ลำดับ</b></td>
                <td style="padding-top:7px;" align="center" width="125px"><b>รหัสใบคำร้อง</b></td>
                <td style="padding-top:7px;" align="center" width="125px"><b>วันที่บันทึก</b></td>
                <td style="padding-top:7px;" align="center"><b>รายการ</b></td>
                <td style="padding-top:7px;" align="center"><b>ลูกค้า</b></td>
                <td style="padding-top:7px;"  align="center" width="125px"><b>จำนวนเงิน</b></td>
            </tr>
                <?php
                $sql = "select * from tb_general where rg_date_back between '".$_GET[date1]."' and '".$_GET[date2]."' and rg_status<>0 and rg_want_type <=3 order by rg_id asc";
                $result = mysql_db_query($dbname, $sql);
                $num = mysql_num_rows($result);
                if (mysql_num_rows($result) > 0) {
                    while ($array = mysql_fetch_array($result)) {
                        $page++;
                        $sqlcus = "select * from tb_customer where cus_id='" . $array[cus_id] . "'";
                        $resultcus = mysql_db_query($dbname, $sqlcus);
                        $arraycus = mysql_fetch_array($resultcus);

                        if ($array[rg_want_type] == 0) {
                            $want = "ขอรับเงินประกันการใช้ไฟฟ้าคืน";
                        } elseif ($array[rg_want_type] == 1) {
                            $want = "ขอรับเงินประกันคาปาซิเตอร์คืน";
                        } elseif ($array[rg_want_type] == 2) {
                            $want = "ขอรับเงินประกันหม้อแปลงไฟฟ้าคืน";
                        } elseif ($array[rg_want_type] == 3) {
                            $want = "ขอรับค่าขยายเขตระบบจำหน่ายไฟฟ้าคืน";
                        } elseif ($array[rg_want_type] == 4) {
                            $want = "ขอใช้บริการพิมพ์โฆษณาหลังใบแจ้งหนี้";
                        } elseif ($array[rg_want_type] == 5) {
                            $want = "ขอชำระเงินค่าไฟฟ้าโดยหักจากบัญชีเงินฝากธนาคาร";
                        } elseif ($array[rg_want_type] == 6) {
                            $want = "ขอเช่าพื้นที่โฆษณา";
                        } elseif ($array[rg_want_type] == 7) {
                            $want = "ขอเช่าพาดสายโทรนาคม";
                        } elseif ($array[rg_want_type] == 8) {
                            $want = "ขอเช่าสาย fiber optic";
                        } elseif ($array[rg_want_type] == 9) {
                            $want = "ขอเช่าที่ดิน";
                        } elseif ($array[rg_want_type] == 10) {
                            $want = "ขอซื้อที่ดิน";
                        } elseif ($array[rg_want_type] == 11) {
                            $want = "ขอใช้ไฟฟ้าที่ กฟภ. สนับสนุน";
                        } else {
                            $want = $array[rg_want_other];
                        }
                        if ($array[rg_status] == 0) {
                            $label = "ยังไม่อนุมัติ";
                        } elseif ($array[rg_status] == 1) {
                            $label = "อนุมัติแล้ว";
                        } elseif ($array[rg_status] == 2) {
                            $label = "ยกเลิกใบคำร้อง";
                        } elseif ($array[rg_status] == 3) {
                            $label = "เสร็จสิ้น";
                        }
                        if ($array[rg_money] == 0) {
                            $money = "xxxx";
                            $text = "center";
                        } else {
                            $money = number_format($array[rg_money], 2);
                            $text = "right";
                        }
                        $summoney+=$array[rg_money];
?>	
                        <tr>
                            <td style="padding-top:7px;" align="center"><?= $page ?></td>
                            <td  style="padding-top:7px;" align="center"><?= $array[rg_id] ?></td>
                            <td  style="padding-top:7px;" align="center"><?= Dateim($array[rg_date_back]); ?></td>
                            <td  style="padding-top:7px;" ><?= $want ?></td>
                            <td style="padding-top:7px;"><?= $arraycus[cus_name] ?></td>
                            <td style="padding-top:7px; padding-right:7px;" align="<?=$text?>" ><?= $money ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td style="padding-top:7px; padding-right:7px;" colspan="3" align="right"><b>รวมทั้งสิ้น</b></td>
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