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
            <tr >
                <td colspan="6" align="center" style="background-color:#337ab7; color: #fff; padding-top:7px;" >
                    <h3>รายงานคำร้องขอใช้ไฟฟ้า</h3>
                </td>
            </tr>
            <tr>
                <td style="padding-top:7px;" align="center" width="50px"><b>ลำดับ</b></td>
                <td style="padding-top:7px;" align="center" width="125px"><b>รหัสใบคำร้อง</b></td>
                <td style="padding-top:7px;" align="center" width="125px"><b>วันที่บันทึก</b></td>
                <td style="padding-top:7px;" align="center"><b>รายการ</b></td>
                <td style="padding-top:7px;" align="center"><b>ลูกค้า</b></td>
                <td style="padding-top:7px;"  align="center" width="175px"><b>สถานะ</b></td>
            </tr>
                <?php
                $sql = "select * from tb_electricity where re_date between '".$_GET[date1]."' and '".$_GET[date2]."'  order by re_id asc";
                $result = mysql_db_query($dbname, $sql);
                $num = mysql_num_rows($result);
                if (mysql_num_rows($result) > 0) {
                    while ($array = mysql_fetch_array($result)) {
                        $page++;
                        $sqlcus = "select * from tb_customer where cus_id='" . $array[cus_id] . "'";
                        $resultcus = mysql_db_query($dbname, $sqlcus);
                        $arraycus = mysql_fetch_array($resultcus);

                        if ($array[re_want_type] == 0) {
                            $want = "ขอติดตั้งมิเตอร์ใหม่";
                        } elseif ($array[re_want_type] == 1) {
                            $want = "ขอตัดฝากมิเตอร์โดยไม่ใช้ไฟฟ้า";
                        } elseif ($array[re_want_type] == 2) {
                            $want = "ขอต่อกลับการใช้ไฟฟ้า";
                        } elseif ($array[re_want_type] == 3) {
                            $want = "ขอเพื่มขนาดมิเตอร์/อุปกรณ์ประกอบ";
                        } elseif ($array[re_want_type] == 4) {
                            $want = "ขอเปลี่ยนประเภทมิเตอร์";
                        } elseif ($array[re_want_type] == 5) {
                            $want = "ขอหยุดซ่อมแซมเครื่องจักรประจำปี";
                        } elseif ($array[re_want_type] == 6) {
                            $want = "ขอใช้ไฟฟ้าชั่วคราวแบบเหมาจ่าย";
                        } elseif ($array[re_want_type] == 7) {
                            $want = "ขอติดตั้งไฟฟ้าชั่วคราว";
                        } elseif ($array[re_want_type] == 8) {
                            $want = "ขอตัดฝากมิเตอร์ใช้เพื่อแสงสว่างไม่ลด CT";
                        } elseif ($array[re_want_type] == 9) {
                            $want = "ขอยกเลิกเลิกการใช้ไฟฟ้า";
                        } elseif ($array[re_want_type] == 10) {
                            $want = "ชอลดขนาดมิเตอร์/อุปกรณ์ประกอบ";
                        } elseif ($array[re_want_type] == 11) {
                            $want = "ขอใช้ไฟฟ้าสาธารณะ";
                        } elseif ($array[re_want_type] == 12) {
                            $want = "ขอตัดมิเตอร์ใช้เพื่อแสงสว่างลด CT";
                        } elseif ($array[re_want_type] == 13) {
                            $want = "ขอย้ายจุดติดตั้งมิเตอร์/อุปกรณ์ประกอบ";
                        } elseif ($array[re_want_type] == 14) {
                            $want = "ขอเปลี่ยนมิเตอร์กรณีชำรุด";
                        } elseif ($array[re_want_type] == 15) {
                            $want = "ขอใช้ไฟฟ้าตู้โทรศัพท์ต่อตรง";
                        } elseif ($array[re_want_type] == 16) {
                            $want = $array[re_place_other];
                        }
                        if ($array[re_status] == 0) {
                            $label = "ยังไม่ได้สำรวจ";
                            $status = "#848480";
                        } elseif ($array[re_status] == 1) {
                            $status = "#5bc0de";
                            $label = "ผ่านการสำรวจแล้ว";
                        } elseif ($array[re_status] == 2) {
                            $status = "#F78234";
                            $label = "ชำระค่าธรรมเนียมแล้ว";
                        } elseif ($array[re_status] == 3) {
                            $status = "#99cc00";
                            $label = "บันทึกการปฎิบัติงานแล้ว";
                        } elseif ($array[re_status] == 4) {
                            $status = "#16DD87";
                            $label = "ไม่ผ่านการตรวจสอบมาตรฐาน,รอแก้ไข";
                        } elseif ($array[re_status] == 5) {
                            $status = "#751C90";
                            $label = "ไม่ผ่านการตรวจสอบมาตรฐาน,รอตรวจสอบใหม่";
                        } elseif ($array[re_status] == 6) {
                            $status = "#2E9AFE";
                            $label = "เสร็จสิ้น";
                        } elseif ($array[re_status] == 9) {
                            $status = "#d9534f";
                            $label = "ไม่ผ่านการสำรวจ";
                        }
                        ?>	
                        <tr>
                            <td style="padding-top:7px;" align="center"><?= $page ?></td>
                            <td  style="padding-top:7px;" align="center"><?= $array[re_id] ?></td>
                            <td  style="padding-top:7px;" align="center"><?= Dateim($array[re_date]); ?></td>
                            <td  style="padding-top:7px;" align="center"><?= $want ?></td>
                            <td style="padding-top:7px;" align="center"><?= $arraycus[cus_name] ?></td>
                            <td style="padding-top:7px;" align="center"><?= $label ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td style="padding-top:7px; padding-right:7px;" colspan="5" align="right"><b>รวมทั้งสิ้น</b></td>
                        <td style="padding-top:7px; padding-right:7px;" align="right"><?= $num ?> รายการ</td>
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