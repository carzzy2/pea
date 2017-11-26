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
            include "fee_print_re.php";
        }else{
            include "fee_print_rg.php";
        }
        ?>
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