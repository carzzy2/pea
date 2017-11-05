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
        $sql_ch = "select * from  tb_fee where fee_id='" . $_GET[fee_id] . "'";
        $result_ch = mysql_db_query($dbname, $sql_ch);
        $array_ch = mysql_fetch_array($result_ch);
        if($array_ch[re_id]!=""){
        ?>
        
        <?php
        $sql_print = "select * from  tb_fee,tb_user,tb_meter where fee_id='" . $_GET[fee_id] . "' and tb_fee.user_id=tb_user.user_id";
        $result_print = mysql_db_query($dbname, $sql_print);
        $array_print = mysql_fetch_array($result_print);
        ?>
        <table  align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
                <tr >
                    <td colspan="2" width="70px" style="border-right-color: white;">
                <center>
                    <img  src="img/lo.png" width="70" >
                </center>
            </td>
        </table>
        <table width="100%"  align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
            <tr>
                <td valign="top" colspan="2">
                    ใบเสร็จเลขที่ <?= $array_print[fee_id] ?><br>
                                       การไฟฟ้าส่วนภูมิภาคขอนแก่น(มะลิวัลย์)(สาขาที่ 00918)<br>
                        เลขที่ 444 หมู่ 8 ถนนมะลิวัลย์ ตำบลบ้านเป็ด อำเภอเมืองขอนแก่น จังหวัดขอนแก่น 40000<br>
                        
                </td>
            </tr>
        </table>
        <hr >
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
        $tt =($array_print['fee_price'] *100) /107;
        $tex=$array_print['fee_price'] - $tt ;
        
        ?>
        <table width="100%"  align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
            <tr>
                <td colspan="4" style="padding-top:9px;">
                    รหัสใบคำร้อง : <?= $array_ele[re_id] ?> <br>
                    ชื่อ : <?= $array_ele[cus_name] ?> <br>
                    ที่อยู่ :บ้านเลขที่ <?=$array_ele[cus_number]?> หมู่บ้าน/อาคาร <?=$array_ele[cus_village]?> ซ. <?=$array_ele[cus_alleyway]?> ถ. <?=$array_ele[cus_road]?> ม. <?=$array_ele[cus_vilno]?> ต. <?=$array_ele[cus_district]?> อ. <?=$array_ele[cus_canton]?> จ. <?=$array_ele[cus_province]?> <?=$array_ele[cus_post]?><br>

                    รายการ : <?= $want ?>
                </td>
            </tr>
            <tr>
                    <td colspan="4" >
                        รายการ: <?= $want ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        จำนวนเงิน
                    </td>
                    <td colspan="2" align='right'>
                        <?= number_format($tt, 2) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        ภาษีมูลค่าเพื่ม
                    </td>
                    <td colspan="2" align='right'>
                        <?= number_format($tex, 2) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        รวมทั้งสิ้น
                    </td>
                    <td colspan="2" align='right' >
                        <?= number_format(($array_print['fee_price']), 2) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:15px;">
                        ชำระ
                    </td>
                    <td colspan="2" align='right' style="padding-top:15px;">
                        <?= number_format(($array_print['fee_price']), 2) ?>
                    </td>
                </tr>
                <tr>
                <td colspan="4" style="padding-top:9px;">
                    วันที่ชำระ <?= Dateim($array_print[fee_date]);?>
                    
                </td>

            </tr>
        </table>
        <hr>
        <?php
        
        }else{
            
        ?>
        <?php
        $sql_print = "select * from  tb_fee,tb_user,tb_general,tb_customer where fee_id='" . $_GET[fee_id] . "' and tb_fee.user_id=tb_user.user_id and tb_fee.rg_id=tb_general.rg_id and tb_customer.cus_id = tb_general.cus_id";
        $result_print = mysql_db_query($dbname, $sql_print);
        $array_print = mysql_fetch_array($result_print);
        ?>
        <br>
            <table  align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
                <tr >
                    <td colspan="2" width="70px" style="border-right-color: white;">
                <center>
                    <img  src="img/lo.png" width="70" >
                </center>
            </td>
        </table>
        <table style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
            <tr>
                <td valign="top" colspan="2">
                    ใบเสร็จเลขที่ <?= $array_print[fee_id] ?><br>
                                       การไฟฟ้าส่วนภูมิภาคขอนแก่น(มะลิวัลย์)(สาขาที่ 00918)<br>
                        เลขที่ 444 หมู่ 8 ถนนมะลิวัลย์ ตำบลบ้านเป็ด อำเภอเมืองขอนแก่น จังหวัดขอนแก่น 40000<br>
                        
                </td>
            </tr>
        </table>
        <hr >
        <?php
        if($array_print[rg_want_type]==0){
            $want="ขอรับเงินประกันการใช้ไฟฟ้าคืน";
        }elseif($array_print[rg_want_type]==1){
            $want="ขอรับเงินประกันคาปาซิเตอร์คืน";
        }elseif($array_print[rg_want_type]==2){
            $want="ขอรับเงินประกันหม้อแปลงไฟฟ้าคืน";
        }elseif($array_print[rg_want_type]==3){
            $want="ขอรับค่าขยายเขตระบบจำหน่ายไฟฟ้าคืน";
        }elseif($array_print[rg_want_type]==4){
            $want="ขอใช้บริการพิมพ์โฆษณาหลังใบแจ้งหนี้";
        }elseif($array_print[rg_want_type]==5){
            $want="ขอชำระเงินค่าไฟฟ้าโดยหักจากบัญชีเงินฝากธนาคาร";
        }elseif($array_print[rg_want_type]==6){
            $want="ขอเช่าพื้นที่โฆษณา";
        }elseif($array_print[rg_want_type]==7){
            $want="ขอเช่าพาดสายโทรนาคม";
        }elseif($array_print[rg_want_type]==8){
            $want="ขอเช่าสาย fiber optic";
        }elseif($array_print[rg_want_type]==9){
            $want="ขอเช่าที่ดิน";
        }elseif($array_print[rg_want_type]==10){
            $want="ขอซื้อที่ดิน";
        }elseif($array_print[rg_want_type]==11){
            $want="ขอใช้ไฟฟ้าที่ กฟภ. สนับสนุน";
        }else{
           $want=$array_print[rg_want_other]; 
        }
        $tt =($array_print['fee_price'] *100) /107;
        $tex=$array_print['fee_price'] - $tt ;
        
        ?>
        <table width="100%"  align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px;">
            <tr>
                <td colspan="4" style="padding-top:9px;">
                    รหัสใบคำร้อง : <?= $array_print[rg_id] ?> <br>
                    ชื่อ : <?= $array_print[cus_name] ?> <br>
                    ที่อยู่ :บ้านเลขที่ <?=$array_print[cus_number]?> หมู่บ้าน/อาคาร <?=$array_print[cus_village]?> ซ. <?=$array_print[cus_alleyway]?> ถ. <?=$array_print[cus_road]?> ม. <?=$array_print[cus_vilno]?> ต. <?=$array_print[cus_district]?> อ. <?=$array_print[cus_canton]?> จ. <?=$array_print[cus_province]?> <?=$array_print[cus_post]?><br>
                    
                </td>

            </tr>
            <tr>
                    <td colspan="4" >
                        รายการ: <?= $want ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        จำนวนเงิน
                    </td>
                    <td colspan="2" align='right'>
                        <?= number_format($tt, 2) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        ภาษีมูลค่าเพื่ม
                    </td>
                    <td colspan="2" align='right'>
                        <?= number_format($tex, 2) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        รวมทั้งสิ้น
                    </td>
                    <td colspan="2" align='right' >
                        <?= number_format(($array_print['fee_price']), 2) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:15px;">
                        ชำระ
                    </td>
                    <td colspan="2" align='right' style="padding-top:15px;">
                        <?= number_format(($array_print['fee_price']), 2) ?>
                    </td>
                </tr>
                <tr>
                <td colspan="4" style="padding-top:9px;">
                    วันที่ชำระ <?= Dateim($array_print[fee_date]);?>
                    
                </td>

            </tr>
        </table>
        <hr>
        <?php
        }
        ?>
    </body>
</html>
<?Php
$html = ob_get_contents();
ob_end_clean();

$pdf = new mPDF('th', array( 90,165 ), '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetLeftMargin( 0 );
$pdf->SetTopMargin( 0);
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>