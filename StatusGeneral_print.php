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
$sql_print = "select * from tb_user,tb_general,tb_customer where rg_id='" . $_GET[id] . "' and tb_user.user_id=tb_general.user_id and tb_customer.cus_id=tb_general.cus_id";
$result_print = mysql_db_query($dbname, $sql_print);
$array_print = mysql_fetch_array($result_print);
?>
        <br>
            <table  align="center" >
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
        
        ?>
        <table width="100%"   align="center" style="font-size: 11px;">
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
                        <?= number_format($array_print['rg_money'], 2) ?>
                    </td>
                </tr>
        </table>
        <hr>
    </body>
</html>
<?Php
$html = ob_get_contents();
ob_end_clean();

$pdf = new mPDF('th', array( 90,140 ), '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetLeftMargin( 0 );
$pdf->SetTopMargin( 0);
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>