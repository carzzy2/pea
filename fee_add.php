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
                                    <label>รหัสชำระเงิน</label>
                                    <input class="form-control" autocomplete=off  name="fee_id" type="text" id="fee_id" value="<?= $feeid ?>" size="30" readonly/>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>วัน/เดือน/ปี</label>
                                    <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_date" type="text" id="re_date" value="<?= date("d/m/") . (date("Y") + 543) ?>"  readonly/>	
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>เจ้าหน้าที่ผู้รับคำร้อง</label>
                                    <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="user_id" type="text" id="user_id" value="<?=$user[user_name]?> <?=$user[user_last]?>" readonly/>	
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>เลขที่คำร้องขอใช้ไฟฟ้า</label>
                                    <select id="re_id" class="form-control" name="re_id" OnChange="window.location = '?item=' + this.value;">
                                        <option value=""><-- เลือกเลขที่คำร้องขอใช้ไฟฟ้า --></option>
                                        <?php
                                        $strSQL = "SELECT * FROM tb_electricity where re_status='1' ORDER BY re_id ASC";
                                        $objQuery = mysql_query($strSQL);
                                        while ($objResult = mysql_fetch_array($objQuery)) {
                                            if ($_GET["item"] == $objResult["re_id"]) {
                                                $sel = "selected";
                                            } else {
                                                $sel = "";
                                            }
                                            ?>
                                            <option value="<?= $objResult["re_id"]; ?>"<?php echo $sel; ?>><?= $objResult["re_id"]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                            </div>
                            <?php
                            if ($_GET["item"] != "") {
                                    $sql = "select * from tb_electricity ele,tb_customer cus where re_id='" . $_GET[item] . "' and ele.cus_id=cus.cus_id";
                                    $result = mysql_db_query($dbname, $sql);
                                    $array = mysql_fetch_array($result);
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
                                <div class="col-sm-3 form-group">
                                    <label>มีความประสงค์</label>
                                    <input class="form-control" autocomplete=off  value="<?= $want ?>" size="30" readonly/>
                                </div>
                            </div>
                                <table  class="table table-bordered table-hover">
                                    <thead>               
                                        <tr>             
                                            <th class="text-center" width="150px">รหัสสำรวจ</th>
                                            <th class="text-center">วันที่สำรวจ</th>
                                            <th class="text-center">รายการ</th>
                                            <th  class="text-center" width="200px">จำนวนเงิน</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                        function Dateim($mydate) {
                                            $d = split("-", $mydate);
                                            $mydate = $d[2] . "/" . $d[1] . "/" . ($d[0] + 543);
                                            return "$mydate";
                                        }
                                                $sql_mat = "select * from tb_equipment,tb_meter where tb_equipment.re_id='" . $_GET['item'] . "' and tb_equipment.equ_status='0' and tb_meter.me_id=tb_equipment.me_id";
                                                $result_mat = mysql_db_query($dbname, $sql_mat);
                                                $array_mat = mysql_fetch_array($result_mat);
                                                $total=($array_mat['me_price']*7)/100+$array_mat['me_price'];
                                                ?>		
                                                <tr>
                                                    <td class="text-center"><?= $array_mat['equ_id'] ?></td>
                                                    <td class="text-center"><?= Dateim($array_mat['equ_date']); ?></td>
                                                    <td><?=$array_mat['me_name'] ?></td>
                                                    <td class="text-right"><?= number_format($array_mat['me_price'],2) ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td  class="text-right"><b>ภาษีมูลค่าเพื่ม</b></td>
                                                    <td  class="text-right"><b><?= number_format(($array_mat['me_price']*7)/100,2) ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td  class="text-right"><b>รวมทั้งสิ้น</b></td>
                                                    <td  class="text-right"><b><?= number_format($total,2) ?></b></td>
                                                </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <center>
                                <input type="hidden" name="send_type" value="reid" >
                                <input type="hidden" name="fee_price" value="<?=$total?>" >
                                <a class="btn btn-info" onclick="location.href = 'fee_show.php'"> ย้อนกลับ</a>
                                <button class="btn  btn-success" name="Submit" type="submit" value="1">บันทึก</button>                            
                            </center>
                        </div>
                    </form> 
                </div>


            </div>
        </div>
    </body>

</html>
