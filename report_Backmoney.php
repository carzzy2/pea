<?php
@session_start();
include "connect_db.php";
$ses_userid = $_SESSION[ses_userid];
$ses_username = $_SESSION[loginid];
if ($ses_userid <> session_id() or $ses_username == "") {
    echo "<script>alert('กรุณาลงชื่อเข้าสู่ระบบก่อน');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
    exit();
}
function Dateim($mydate){
    $d=split("-",$mydate);
    $mydate=$d[2]."/".$d[1]."/".($d[0]+543);
    return "$mydate";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PEA</title>
        <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet"><!-- Bootstrap Core CSS -->
        <link href="vendor/metisMenu/metisMenu.css" rel="stylesheet"><!-- MetisMenu CSS -->
        <link href="dist/css/sb-admin-2.css" rel="stylesheet"><!-- Custom CSS -->
        <link href="vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"><!-- Custom Fonts -->
        <script src="vendor/jquery/jquery.min.js"></script><!-- jQuery -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script><!-- Bootstrap Core JavaScript -->
        <script src="vendor/metisMenu/metisMenu.min.js"></script><!-- Metis Menu Plugin JavaScript -->
        <script src="dist/js/sb-admin-2.js"></script><!-- Custom Theme JavaScript -->
        <script src="dist/excellentexport.js"></script>
    </head>
    <body>
        <?php include "header.php"; ?>
        <?php
        include"sidebar.php";
        ?>
        <div id="page-wrapper">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">รายงานบันทึกขอคืนเงิน</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="get" name="report" class="form-inline col-md-12 col-sm-6" style="margin-bottom: 30px; float:left; text-align: center;">
                                <h3 class="text-center">เลือกตัวกรอง</h3>
                                <label style="margin-top: 7px; width: 60px;">เริ่มวันที่</label>
                                <div class="input-group">
                                    <span class="input-group-addon " title="Select date">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    <input type="date" name="txtdate1" id="date1" class="form-control" value="<?=$_GET['txtdate1']?>">
                                </div>            
                                <label style="margin-top: 7px;">ถึงวันที่</label>
                                <div class="input-group">
                                    <span class="input-group-addon" title="Select date">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    <input type="date" name="txtdate2" id="date2" class="form-control" value="<?=$_GET['txtdate2']?>">
                                </div>        
                                <button type="submit" class="btn btn-primary">แสดงรายงาน</button>
                            </form>
                        </div>
                        <?php
                        $date1=$_GET['txtdate1'];
                        $date2=$_GET['txtdate2'];
                        if($date1!='' and $date2!=''){
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="pull-right">
                                        <a  class="btn btn-info" target="_blank"  href="report_Backmoney_print.php?date1=<?=$_GET['txtdate1']?>&date2=<?=$_GET['txtdate2']?>" >Print</a>
                                    </div>
                                </div>
                            <div class="clearfix"></div><br>
                            <div class="col-md-12">
                                <div class="table-responsive" >
                                    <table class="table table-bordered table-hover" id="table-data">
                                        <thead>               
                                            <tr>
                                                <th class=" text-center" >ลำดับ</th>
                                                <th class=" text-center" >รหัสใบคำร้อง</th>
                                                <th class=" text-center" >วันที่บันทึก</th>
                                                <th class=" text-center" >รายการ</th>
                                                <th class=" text-center" >ลูกค้า</th>
                                                <th class=" text-center">จำนวนเงิน</th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "select * from tb_general where rg_date_back between '".$_GET[txtdate1]."' and '".$_GET[txtdate2]."' and rg_status<>0 and rg_want_type <=3  order by rg_id desc";
                                            $result = mysql_db_query($dbname, $sql);
                                            $num=mysql_num_rows($result);
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
                                                    if($array[rg_money]==0){
                                                        $money="xxxx";
                                                        $text="center";
                                                    }else{
                                                        $money=number_format($array[rg_money],2);
                                                        $text="right";
                                                    }
                                                    $summoney+=$array[rg_money];
                                                    ?>	
                                                    <tr>
                                                        <td class="text-center"><?= $page ?></td>
                                                        <td class=" text-center"><?= $array[rg_id] ?></td>
                                                        <td class=" text-center"><?= Dateim($array[rg_date_back]); ?></td>
                                                        <td><?= $want ?></td>
                                                        <td><?= $arraycus[cus_name] ?></td>
                                                        <td class="text-<?=$text?>"><?= $money ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="text-right" colspan="3"><b>รวมทั้งสิ้น</b></td>
                                                        <td><?= $num ?> รายการ</td>
                                                        <td class="text-right" ><b>เป็นเงิน</b></td>
                                                        <td class="text-right"><?= number_format($summoney,2) ?> บาท</td>
                                                    </tr>
                                                    <?php
                                                
                                            } else {
                                                ?>				  
                                            <tr><td colspan="7" align="center">ไม่พบข้อมูล</td></tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
