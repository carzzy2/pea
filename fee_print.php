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
?>
<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $sql_print = "select * from  tb_fee,tb_user,tb_meter where fee_id='" . $_GET[fee_id] . "' and tb_fee.user_id=tb_user.user_id";
        $result_print = mysql_db_query($dbname, $sql_print);
        $array_print = mysql_fetch_array($result_print);
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
                        ใบเสร็จชำระเงิน</b>
                </td>
                <td valign="top" style="padding-top:7px;" colspan="2">
                    รหัสชำระเงิน <?= $array_print[fee_id] ?><br>
                    ผู้รับเงิน <?= $array_print[user_name] ?> <?= $array_print[user_last] ?><br>
                    วันที่ <?= Dateim($array_print[fee_date]); ?>
                </td>
            </tr>
        </table>
        <?php
        $sql_ele = "select * from  tb_electricity,tb_equipment,tb_meter,tb_customer where tb_electricity.re_id='" . $array_print[re_id] . "' and tb_equipment.me_id=tb_meter.me_id and tb_electricity.cus_id=tb_customer.cus_id and tb_equipment.equ_status='0' ";
        $result_ele = mysql_db_query($dbname, $sql_ele);
        $array_ele = mysql_fetch_array($result_ele);
        if ($array_ele[re_want_type] == 0) {
            $want = "ขอติดตั้งมิเตอร์ใหม่";
        } elseif ($array_ele[re_want_type] == 1) {
            $want = "ขอตัดฝากมิเตอร์โดยไม่ใช้ไฟฟ้า";
        } elseif ($array_ele[re_want_type] == 2) {
            $want = "ขอต่อกลับการใช้ไฟฟ้า";
        } elseif ($array_ele[re_want_type] == 3) {
            $want = "ขอเพื่มขนาดมิเตอร์/อุปกรณ์ประกอบ";
        } elseif ($array_ele[re_want_type] == 4) {
            $want = "ขอเปลี่ยนประเภทมิเตอร์";
        } elseif ($array_ele[re_want_type] == 5) {
            $want = "ขอหยุดซ่อมแซมเครื่องจักรประจำปี";
        } elseif ($array_ele[re_want_type] == 6) {
            $want = "ขอใช้ไฟฟ้าชั่วคราวแบบเหมาจ่าย";
        } elseif ($array_ele[re_want_type] == 7) {
            $want = "ขอติดตั้งไฟฟ้าชั่วคราว";
        } elseif ($array_ele[re_want_type] == 8) {
            $want = "ขอตัดฝากมิเตอร์ใช้เพื่อแสงสว่างไม่ลด CT";
        } elseif ($array_ele[re_want_type] == 9) {
            $want = "ขอยกเลิกเลิกการใช้ไฟฟ้า";
        } elseif ($array_ele[re_want_type] == 10) {
            $want = "ชอลดขนาดมิเตอร์/อุปกรณ์ประกอบ";
        } elseif ($array_ele[re_want_type] == 11) {
            $want = "ขอใช้ไฟฟ้าสาธารณะ";
        } elseif ($array_ele[re_want_type] == 12) {
            $want = "ขอตัดมิเตอร์ใช้เพื่อแสงสว่างลด CT";
        } elseif ($array_ele[re_want_type] == 13) {
            $want = "ขอย้ายจุดติดตั้งมิเตอร์/อุปกรณ์ประกอบ";
        } elseif ($array_ele[re_want_type] == 14) {
            $want = "ขอเปลี่ยนมิเตอร์กรณีชำรุด";
            
        }
        $tex=$array_print['fee_price'] - $array_ele['me_price'];
        ?>
        <table width="100%" border="1" align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
            <tr>
                <td colspan="4" style="padding-top:9px;">
                    รหัสใบคำร้องขอใช้ไฟฟ้า : <?= $array_ele[re_id] ?> <br>
                    ชื่อลูกค้า : <?= $array_ele[cus_name] ?> <br>
                    เบอร์โทรศัพท์ : <?= $array_ele[cus_tel] ?><br>
                    มีความประสงค์ : <?= $want ?>
                </td>
            </tr>
        </table>
        <table width="100%" border="1" align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
            <thead>               
                <tr>             
                    <th>รหัสสำรวจ</th>
                    <th >วันที่สำรวจ</th>
                    <th >รายการ</th>
                    <th >จำนวนเงิน</th>
                </tr> 
            </thead>
            <tbody>		
                <tr>
                    <td align="center"><?= $array_ele['equ_id'] ?></td>
                    <td align="center"><?= Dateim($array_ele['equ_date']); ?></td>
                    <td ><?= $array_ele['me_name'] ?></td>
                    <td align="right"><?= number_format($array_ele['me_price'], 2) ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td  align="right"><b>ภาษีมูลค่าเพื่ม</b></td>
                    <td  align="right"><b><?= number_format($tex, 2) ?></b></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td align="right"><b>รวมทั้งสิ้น</b></td>
                    <td align="right"><b><?= number_format(($array_print['fee_price']), 2) ?></b></td>
                </tr>
            </tbody>
        </table>
        <table width="100%" border="1" align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
            <tr>
                <td valign="top" colspan="4" style="padding-top:7px;">

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
<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>