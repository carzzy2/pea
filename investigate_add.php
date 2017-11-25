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
        $new_id = mysql_result(mysql_query("Select Max(substr(ig_id,-4))+1 as MaxID from tb_investigate"), 0, "MaxID");
        if ($new_id == '') {
            $feeid = "160000000001";
        } else {
            $feeid = "16" . sprintf("%010d", $new_id);
        }
        ?>
        <div id="page-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">ตรวจสอบมาตรฐาน</h2>
                </div>
                <div class="panel-body">
                    <form method="post" action="work_cal.php">
                        <div class="col-sm-12">
                            <div class="row">
                                    <div class="col-sm-3 form-group">
                                    <label>เลขที่คำร้องขอใช้ไฟฟ้า</label>
                                     <select id="re_id" class="form-control" name="re_id" >
                                        <option value=""><-- เลือกเลขที่คำร้องขอใช้ไฟฟ้า --></option>
                                        <?php
                                        $strSQL = "SELECT * FROM tb_electricity where re_status='3' ORDER BY re_id ASC";
                                        $objQuery = mysql_query($strSQL);
                                        while ($objResult = mysql_fetch_array($objQuery)) {
                                            ?>
                                            <option value="<?= $objResult["re_id"]; ?>"><?= $objResult["re_id"]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>รหัสตรวจสอบ</label>
                                    <input class="form-control" autocomplete=off  name="fee_id" type="text" id="fee_id" value="<?= $feeid ?>" size="30" readonly/>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>วัน/เดือน/ปี</label>
                                    <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_date" type="text" id="re_date" value="<?= date("d/m/") . (date("Y") + 543) ?>"  readonly/>	
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label>ความเห็นของผู้ตรวจสอบ</label>
                                        </div>
                                    </div>    
                                    <div class="row">
                                        <div class="form-group col-sm-2">
                                            <label>1. สายแม่แรงต่ำ ขนาด</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="equ_tran_unit" min="0"  required>
                                                <span class="input-group-addon">ตร.มม</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label>จำนวน</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="equ_tran_unit" min="0"  required>
                                                <span class="input-group-addon">เฟส</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="equ_tran_unit" min="0"  required>
                                                <span class="input-group-addon">สาย</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label>2. จ่ายไฟจากสถานไฟฟ้าย่อย</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="equ_tran_unit" min="0"  required>
                                                <span class="input-group-addon">ฟีดเดอร์แรงสูง</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label>ปีจัดซื้อ(ตาม มป.5)</label>
                                            <div class="form-group">
                                                <select id="equ_tran" class="form-control" name="equ_tran" required>
                                                    <option value=""><-- เลือกปี --></option>
                                                    <option value="2560">2560</option>
                                                    <option value="2559">2559</option>
                                                    <option value="2558">2558</option>
                                                    <option value="2557">2557</option>
                                                    <option value="2556">2556</option>
                                                    <option value="2555">2555</option>
                                                    <option value="2554">2554</option>
                                                    <option value="2553">2553</option>
                                                    <option value="2552">2552</option>
                                                    <option value="2551">2551</option>
                                                    <option value="2550">2550</option>
                                                    

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label>(3) ดวงโคม</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="equ_lantern" min="0" required>
                                                <span class="input-group-addon">ดวง</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label>(4) เต้าเสียบ</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control"  name="equ_outlet" min="0" required>
                                                <span class="input-group-addon">ชุด</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label>(5) พัดลม</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="equ_fan" min="0" required>
                                                <span class="input-group-addon">เครื่อง</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label>(6) มิเตอร์</label>
                                            <div class="form-group">
                                                <select id="me_id" class="form-control" name="me_id" required>
                                                    <option value=""><-- เลือกขนาดหม้อแปลง --></option>
                                                    <?php
                                                    $sqlmeter = "SELECT * FROM tb_meter where me_type='" . $array['re_want_type'] . "' ";
                                                    $querrymeter = mysql_query($sqlmeter);
                                                    while ($arraymeter = mysql_fetch_array($querrymeter)) {
                                                        ?>
                                                        <option value="<?= $arraymeter['me_id']; ?>" ><?= $arraymeter['me_name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label>จำนวน</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="equ_meter_unit" min="0" required>
                                                <span class="input-group-addon">ตัว</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label>(6)อื่นๆ ระบุ</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="equ_detail">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <center>
                                <a class="btn btn-info" onclick="location.href = 'work_show.php'"> ย้อนกลับ</a>
                                <input class="btn btn-success" name="finish" type="submit" id="finish" <?=$enable?> title="<?=$title?>" value="บันทึก" >             
                            </center>
                        </div>
                    </form> 
                </div>


            </div>
        </div>
    </body>

</html>
