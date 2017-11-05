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
function Dateim($mydate) {
    $d = split("-", $mydate);
    $mydate = $d[2] . "/" . $d[1] . "/" . ($d[0] + 543);
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
        <script src="vendor/jquery/jquery.alphanumeric.js"></script><!-- jQuery -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script><!-- Bootstrap Core JavaScript -->
        <script src="vendor/metisMenu/metisMenu.min.js"></script><!-- Metis Menu Plugin JavaScript -->
        <script src="dist/js/sb-admin-2.js"></script><!-- Custom Theme JavaScript -->

    </head>

    <body>
        <?php include "header.php";
        ?>

        <?php
        include"sidebar.php";
        ?>
        <?php
        $sql = "select * from tb_fee,tb_user where fee_id='" . $_GET[fee_id] . "' and tb_fee.user_id=tb_user.user_id";
        $result = mysql_db_query($dbname, $sql);
        $array_show = mysql_fetch_array($result);
        
        ?>
        <div id="page-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">รับชำระค่าธรรมเนียม</h2>
                </div>
                <div class="panel-body">
                    <form method="post" action="fee_save.php">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label>รหัสชำระเงิน</label>
                                    <input class="form-control" autocomplete=off  name="fee_id" type="text" id="fee_id" value="<?= $array_show[fee_id] ?>" size="30" readonly/>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>วัน/เดือน/ปี</label>
                                    <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="date" type="text" id="re_date" value="<?= Dateim($array_show[fee_date]); ?>"  readonly/>	
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>เจ้าหน้าที่ผู้รับคำร้อง</label>
                                    <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="user_id" type="text" id="user_id" value="<?=$array_show[user_name]?> <?=$array_show[user_last]?>" readonly/>	
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>เลขที่คำร้องขอทั่วไป</label>
                                    <select id="rg_id" class="form-control" name="rg_id" OnChange="window.location = '?item=' + this.value;" disabled>
                                        <option value=""><-- เลือกเลขที่คำร้องขอทั่วไป --></option>
                                        <?php
                                        $strSQL = "SELECT * FROM tb_general";
                                        $objQuery = mysql_query($strSQL);
                                        while ($objResult = mysql_fetch_array($objQuery)) {
                                            if ($array_show['rg_id'] == $objResult["rg_id"]) {
                                                $sel = "selected";
                                            } else {
                                                $sel = "";
                                            }
                                            ?>
                                            <option value="<?= $objResult["rg_id"]; ?>"<?php echo $sel; ?>><?= $objResult["rg_id"]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                            </div>
                            <?php
                            if ($array_show['rg_id'] != "") {
                                    $sql = "select * from tb_general ge,tb_customer cus where rg_id='" . $array_show['rg_id'] . "' and ge.cus_id=cus.cus_id";
                                    $result = mysql_db_query($dbname, $sql);
                                    $array = mysql_fetch_array($result);
                                    if($array[rg_want_type]==0){
                                        $want="ขอรับเงินประกันการใช้ไฟฟ้าคืน";
                                    }elseif($array[rg_want_type]==1){
                                        $want="ขอรับเงินประกันคาปาซิเตอร์คืน";
                                    }elseif($array[rg_want_type]==2){
                                        $want="ขอรับเงินประกันหม้อแปลงไฟฟ้าคืน";
                                    }elseif($array[rg_want_type]==3){
                                        $want="ขอรับค่าขยายเขตระบบจำหน่ายไฟฟ้าคืน";
                                    }elseif($array[rg_want_type]==4){
                                        $want="ขอใช้บริการพิมพ์โฆษณาหลังใบแจ้งหนี้";
                                    }elseif($array[rg_want_type]==5){
                                        $want="ขอชำระเงินค่าไฟฟ้าโดยหักจากบัญชีเงินฝากธนาคาร";
                                    }elseif($array[rg_want_type]==6){
                                        $want="ขอเช่าพื้นที่โฆษณา";
                                    }elseif($array[rg_want_type]==7){
                                        $want="ขอเช่าพาดสายโทรนาคม";
                                    }elseif($array[rg_want_type]==8){
                                        $want="ขอเช่าสาย fiber optic";
                                    }elseif($array[rg_want_type]==9){
                                        $want="ขอเช่าที่ดิน";
                                    }elseif($array[rg_want_type]==10){
                                        $want="ขอซื้อที่ดิน";
                                    }elseif($array[rg_want_type]==11){
                                        $want="ขอใช้ไฟฟ้าที่ กฟภ. สนับสนุน";
                                    }else{
                                       $want=$array[rg_want_other]; 
                                    }
                                    $sum =($array_show['fee_price'] *100) /107;
                                    $tex=$array_show['fee_price'] - $sum ;
                                ?>
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label>ชื่อลูกค้า</label>
                                    <input class="form-control" autocomplete=off value="<?= $array['cus_name'] ?>" size="30" readonly/>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>เบอร์โทรศัพท์</label>
                                    <input class="form-control" autocomplete=off  value="<?= $array['cus_tel'] ?>" size="30" readonly/>
                                </div>
                            </div>
                                <table  class="table table-bordered table-hover">
                                    <thead>               
                                        <tr>             
                                            <th class="text-center" width="150px">รหัสคำร้อง</th>
                                            <th class="text-center">วันที่บันทึก</th>
                                            <th class="text-center">รายการ</th>
                                            <th  class="text-center" width="200px">จำนวนเงิน</th>
                                        </tr> 
                                    </thead>
                                    <tbody>		
                                        <tr>
                                            <td class="text-center"><?= $array['rg_id'] ?></td>
                                            <td class="text-center"><?= Dateim($array['rg_date']); ?></td>
                                            <td><?=$want?></td>
                                            <td class="text-right"><?=$sum?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td  class="text-right"><b>ภาษีมูลค่าเพื่ม</b></td>
                                            <td  class="text-right"><b><?= number_format($tex,2) ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td  class="text-right"><b>รวมทั้งสิ้น</b></td>
                                            <td  class="text-right"><b><?= number_format($array_show['fee_price'],2) ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <center>
                              
                                <a class="btn btn-info" onclick="location.href = 'fee_show.php'"> ย้อนกลับ</a>
                                <a class="btn btn-default" href="fee_print.php?fee_id=<?= $array_show[fee_id] ?>" target="_blank">พิมพ์</a>                      
                            </center>
                        </div>
                    </form> 
                </div>


            </div>
        </div>
    </body>

</html>
