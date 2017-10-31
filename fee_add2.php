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
        $new_id = mysql_result(mysql_query("Select Max(substr(fee_id,-4))+1 as MaxID from tb_fee"), 0, "MaxID");
        if ($new_id == '') {
            $feeid = "140000000001";
        } else {
            $feeid = "14" . sprintf("%010d", $new_id);
        }
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
                                    <label>เลขที่คำร้องขอทั่วไป</label>
                                    <select id="rg_id" class="form-control" name="rg_id" OnChange="window.location = '?item=' + this.value;">
                                        <option value=""><-- เลือกเลขที่คำร้องขอทั่วไป --></option>
                                        <?php
                                        $strSQL = "SELECT * FROM tb_general where rg_status='1'  ORDER BY rg_id ASC";
                                        $objQuery = mysql_query($strSQL);
                                        while ($objResult = mysql_fetch_array($objQuery)) {
                                            if ($_GET["item"] == $objResult["rg_id"]) {
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
                                <div class="col-sm-3 form-group">
                                    <label>รหัสชำระเงิน</label>
                                    <input class="form-control" autocomplete=off  name="fee_id" type="text" id="fee_id" value="<?= $feeid ?>" size="30" readonly/>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>วัน/เดือน/ปี</label>
                                    <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="date" type="text" id="re_date" value="<?= date("d/m/") . (date("Y") + 543) ?>"  readonly/>	
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>เจ้าหน้าที่ผู้รับคำร้อง</label>
                                    <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="user_id" type="text" id="user_id" value="<?=$user[user_name]?> <?=$user[user_last]?>" readonly/>	
                                </div>
                                
                                
                            </div>
                            <?php
                            if ($_GET["item"] != "") {
                                    $sql = "select * from tb_general ge,tb_customer cus where rg_id='" . $_GET[item] . "' and ge.cus_id=cus.cus_id";
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
                                            <td class="text-right"><input type="text" class="form-control" style="text-align: right" id="fee_price" name="fee_price" ></td>
                                        </tr>
 
                                    </tbody>
                                </table>
                            <?php } ?>
                            <center>
                                <input type="hidden" name="send_type" value="rgid" >
                                <a class="btn btn-info" onclick="location.href = 'fee_show.php'"> ย้อนกลับ</a>
                                <button class="btn  btn-success" name="Submit" type="submit" value="1">บันทึก</button>                            
                            </center>
                        </div>
                    </form> 
                </div>

<script type="text/javascript">
$(document).ready(function(){
	$('#fee_price').numeric();
 
});
</script>
            </div>
        </div>
    </body>

</html>
