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
        <?php include "header.php"; ?>

        <?php
        include"sidebar.php";
        ?>
        <?php
        $sql_print = "select * from  tb_general,tb_user,tb_customer where rg_id='" . $_GET[rg_id] . "' and tb_general.user_id=tb_user.user_id and tb_general.cus_id=tb_customer.cus_id ";
        $result_print = mysql_db_query($dbname, $sql_print);
        $array_edit = mysql_fetch_array($result_print);

        $read = "disabled";

        function Dateim($mydate) {
            $d = split("-", $mydate);
            $mydate = $d[2] . "/" . $d[1] . "/" . ($d[0] + 543);
            return "$mydate";
        }
        ?>
        <div id="page-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">คำร้องทั่วไป</h2>
                </div>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>เลขที่คำร้อง</label>
                                <input class="form-control" autocomplete=off  name="rg_id" type="text" id="rg_id" value="<?= $array_edit[rg_id] ?>" size="30" readonly/>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>กฟฟ(สาขา).</label>
                                <input class="form-control"  name="user_id" type="text" id="user_id" value="<?= $array_edit[rg_branch] ?>" readonly/>	

                            </div>
                            <div class="col-sm-3 form-group">
                                <label>เจ้าหน้าที่ผู้รับคำร้อง</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="user_id" type="text" id="user_id" value="<?= $array_edit[user_name] ?> <?= $user[user_last] ?>" readonly/>	
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>วัน/เดือน/ปี</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_date" type="text" id="rg_date" value="<?= Dateim($array_edit[rg_date]); ?>"  readonly/>	
                            </div>
                        </div>
                        <div class="row ">
                            <label>1.ชื่อผู้ใช้ไฟฟ้า/ลูกค้า</label>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>คำนำหน้า</label>
                                <select id="cus_first" class="form-control" name="cus_first" disabled>
                                    <option style="display: none">--กรุณาเลือก--</option>
                                    <option value="0" <?php if ($array_edit['cus_first'] == "0") { echo "selected=selected";}?>>นาย</option>
                                    <option value="1" <?php if ($array_edit['cus_first'] == "1") {echo "selected=selected";}?>>นาง</option>
                                    <option value="2" <?php if ($array_edit['cus_first'] == "2") {echo "selected=selected";}?>>นางสาว</option>
                                </select>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>ชื่อ-นามสกุล</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_name" type="text" id="cus_name" value="<?= $array_edit[cus_name] ?>"  <?= $read ?>>	
                            </div>
                            <div class="col-sm-5 form-group">
                                <label>ประเภทบัตร</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_type" type="text" id="cus_type" value="<?= $array_edit[cus_type] ?>"  <?= $read ?>>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>รหัสประชาชน </label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" autocomplete=off  name="cus_id" type="text" id="cus_id" value="<?= $array_edit[cus_id] ?>" <?= $read ?>>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>หมายเลขประจำตัวผู้เสียภาษีอากร</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_tax" type="text" id="cus_tax" value="<?= $array_edit[cus_tax] ?>" <?= $read ?>>	
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>หมายเลขผู้ใช้ไฟฟ้า</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_code" type="text" id="cus_code" value="<?= $array_edit[cus_code] ?>" <?= $read ?>>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_homeid" type="text" id="cus_homeid" value="<?= $array_edit[cus_homeid] ?>" <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>เลขที่</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_number" type="text" id="cus_number" value="<?= $array_edit[cus_number] ?>"<?= $read ?>>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>หมู่บ้าน/อาคาร</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_village" type="text" id="cus_village" value="<?= $array_edit[cus_village] ?>" <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>ห้อง</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_room" type="text" id="cus_room" value="<?= $array_edit[cus_room] ?>" <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>ชั้น</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_floor" type="text" id="cus_floor" value="<?= $array_edit[cus_floor] ?>" <?= $read ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label>ตรอก</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_alley" type="text" id="cus_alley" value="<?= $array_edit[cus_alley] ?>" <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>ซอย</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_alleyway" type="text" id="cus_alleyway" value="<?= $array_edit[cus_alleyway] ?>" <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>ถนน</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_road" type="text" id="cus_road" value="<?= $array_edit[cus_road] ?>" <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>หมู่ที่</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_vilno" type="text" id="cus_vilno" value="<?= $array_edit[cus_vilno] ?>" <?= $read ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label>ตำบล</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_district" type="text" id="cus_district" value="<?= $array_edit[cus_district] ?>" <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>อำเภอ</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_canton" type="text" id="cus_canton" value="<?= $array_edit[cus_canton] ?>" <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>จังหวัด</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_province" type="text" id="cus_province" value="<?= $array_edit[cus_province] ?>"<?= $read ?>>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>รหัสไปรษณีย์</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_post" type="text" id="cus_post" value="<?= $array_edit[cus_post] ?>"  maxlength="5" <?= $read ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>โทรศัพท์</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_tel" type="text" id="cus_tel" value="<?= $array_edit[cus_tel] ?>"  maxlength="10"  <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>โทรสาร/Fax</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_fax" type="text" id="cus_fax" value="<?= $array_edit[cus_fax] ?>"  maxlength="10" <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>E-mail</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_email" type="text" id="cus_email" value="<?= $array_edit[cus_email] ?>" <?= $read ?>>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>2.สถานที่ขอใช้บริการ</label>
                            </div>
                            <div class="form-group col-sm-3">
                                <div class="radio-inline">
                                    <label><input name="rg_place_type" size="30" type="radio" <?php if ($array_edit['rg_place_type'] == "0") { echo "checked=checked";}?> <?= $read ?>>เอกชน</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input name="rg_place_type" size="30" type="radio" <?php if ($array_edit['rg_place_type'] == "1") { echo "checked=checked";}?> <?= $read ?>>ราชการ</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input name="rg_place_type" size="30" type="radio"<?php if ($array_edit['rg_place_type'] == "2") { echo "checked=checked";}?> <?= $read ?>>อื่นๆ(ระบุ)</label>
                                </div>

                            </div>
                            <div class="form-group col-sm-4">
                                <input class="form-control" name="rg_place_other" type="text" id="rg_place_other" value="<?= $array_edit[rg_place_other] ?>" <?= $read ?>>	
                            </div> 
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>ชื่อสถานที่ใช้ไฟฟ้า</label>
                                <textarea class="form-control"  rows="2" id="rg_place_name" placeholder="กรุณากรอกข้อมูล" name="rg_place_name" <?= $read ?>><?= $array_edit[rg_place_name] ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_homeid" type="text" id="rg_place_homeid" value="<?= $array_edit[rg_place_homeid] ?>"  <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>เลขที่</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_number" type="text" value="<?= $array_edit[rg_place_number] ?>" <?= $read ?>>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>หมู่บ้าน/อาคาร</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_village" type="text" value="<?= $array_edit[rg_place_village] ?>" <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>ห้อง</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_room" type="text" value="<?= $array_edit[rg_place_room] ?>"  <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>ชั้น</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_floor" type="text" value="<?= $array_edit[rg_place_floor] ?>"  <?= $read ?>/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label>ตรอก</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_alley" type="text" value="<?= $array_edit[rg_place_alley] ?>" <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>ซอย</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_alleyway" type="text" value="<?= $array_edit[rg_place_alleyway] ?>"  <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>ถนน</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_road" type="text" value="<?= $array_edit[rg_place_road] ?>" <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>หมู่ที่</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_villno" type="text" value="<?= $array_edit[rg_place_villno] ?>" <?= $read ?>/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label>ตำบล</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_district" type="text" value="<?= $array_edit[rg_place_name] ?>"  <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>อำเภอ</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_canton" type="text" value="<?= $array_edit[rg_place_canton] ?>"  <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>จังหวัด</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_province" type="text" value="<?= $array_edit[rg_place_province] ?>" <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>รหัสไปรษณีย์</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_post" type="text" value="<?= $array_edit[rg_place_post] ?>" <?= $read ?>/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>โทรศัพท์</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_tel" type="text" value="<?= $array_edit[rg_place_tel] ?>" <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>โทรสาร/Fax</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_fax" type="text" value="<?= $array_edit[rg_place_fax] ?>" <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>E-mail</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_email" type="text" value="<?= $array_edit[rg_place_email] ?>"  <?= $read ?>/>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>ประเภทกิจการ</label>
                                <textarea class="form-control"  rows="2" id="rg_place_service" placeholder="กรุณากรอกข้อมูล" name="rg_place_service"<?= $read ?>><?= $array_edit[rg_place_service] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>3.สถานที่ติดต่อ/ที่อยู่ในการจัดส่งเอกสาร</label>
                            <textarea class="form-control"  rows="2" id="rg_contact_place" placeholder="กรุณากรอกข้อมูล" name="rg_contact_place" <?= $read ?>><?= $array_edit[rg_place_service] ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_homeid" type="text" value="<?= $array_edit[rg_contact_homeid] ?>" <?= $read ?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_number" type="text" value="<?= $array_edit[rg_contact_number] ?>" <?= $read ?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_village" type="text" value="<?= $array_edit[rg_contact_village] ?>" <?= $read ?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_room" type="text"value="<?= $array_edit[rg_contact_room] ?>" <?= $read ?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_floor" type="text" value="<?= $array_edit[rg_contact_floor] ?>" <?= $read ?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_alley" type="text" value="<?= $array_edit[rg_contact_alley] ?>" <?= $read ?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_alleyway" type="text" value="<?= $array_edit[rg_contact_alleyway] ?>" <?= $read ?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_road" type="text" value="<?= $array_edit[rg_contact_road] ?>" <?= $read ?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_villno" type="text" value="<?= $array_edit[rg_contact_villno] ?>" <?= $read ?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_district" type="text" id="rg_contact_district"  value="<?= $array_edit[rg_contact_district] ?>" <?= $read ?>/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_canton" type="text" id="rg_contact_canton"  value="<?= $array_edit[rg_contact_canton] ?>" <?= $read ?>/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_province" type="text" id="rg_contact_province"  value="<?= $array_edit[rg_contact_province] ?>" <?= $read ?>/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_post" type="text" id="rg_contact_post"  maxlength="5" value="<?= $array_edit[rg_contact_post] ?>" <?= $read ?>/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_tel" type="text" id="rg_contact_tel"  value="<?= $array_edit[rg_contact_tel] ?>" <?= $read ?>/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_fax" type="text" id="rg_contact_fax"  value="<?= $array_edit[rg_contact_fax] ?>" <?= $read ?>/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_email" type="text" id="rg_contact_email"  value="<?= $array_edit[rg_contact_email] ?>" <?= $read ?>/>
                        </div>
                    </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>4. มีความประสงค์</label>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-5">
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="0" id="rg_want_type0" <?php if ($array_edit['rg_want_type'] == "0") { echo "checked=checked";}?> <?= $read ?>>ขอรับเงินประกันการใช้ไฟฟ้าคืน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="1" id="rg_want_type1" <?php if ($array_edit['rg_want_type'] == "1") { echo "checked=checked";}?> <?= $read ?>>ขอรับเงินประกันคาปาซิเตอร์คืน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="2" id="rg_want_type2" <?php if ($array_edit['rg_want_type'] == "2") { echo "checked=checked";}?> <?= $read ?>>ขอรับเงินประกันหม้อแปลงไฟฟ้าคืน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="3" id="rg_want_type3" <?php if ($array_edit['rg_want_type'] == "3") { echo "checked=checked";}?> <?= $read ?>>ขอรับค่าขยายเขตระบบจำหน่ายไฟฟ้าคืน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="4" id="rg_want_type4" <?php if ($array_edit['rg_want_type'] == "4") { echo "checked=checked";}?> <?= $read ?>>ขอใช้บริการพิมพ์โฆษณาหลังใบแจ้งหนี้/ใบเสร็จรับเงิน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="5" id="rg_want_type5" <?php if ($array_edit['rg_want_type'] == "5") { echo "checked=checked";}?> <?= $read ?>>ขอชำระเงินค่าไฟฟ้าโดยหักจากบัญชีเงินฝากธนาคาร</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-5">
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="6" id="rg_want_type6" <?php if ($array_edit['rg_want_type'] == "6") { echo "checked=checked";}?> <?= $read ?>>ขอเช่าพื้นที่โฆษณา</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="7" id="rg_want_type7" <?php if ($array_edit['rg_want_type'] == "7") { echo "checked=checked";}?> <?= $read ?>>ขอเช่าพาดสายโทรนาคม</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="8" id="rg_want_type8" <?php if ($array_edit['rg_want_type'] == "8") { echo "checked=checked";}?> <?= $read ?>>ขอเช่าสาย fiber optic</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="9" id="rg_want_type9" <?php if ($array_edit['rg_want_type'] == "9") { echo "checked=checked";}?> <?= $read ?>>ขอเช่าที่ดิน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="10" id="rg_want_type10" <?php if ($array_edit['rg_want_type'] == "10") { echo "checked=checked";}?> <?= $read ?>>ขอซื้อที่ดิน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="11" id="rg_want_type11" <?php if ($array_edit['rg_want_type'] == "11") { echo "checked=checked";}?> <?= $read ?>>ขอใช้ไฟฟ้าที่ กฟภ. สนับสนุน</label>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" id="rg_want_type12" value="12" <?php if ($array_edit['rg_want_type'] == "12") { echo "checked=checked";}?> <?= $read ?>>อื่นๆ ระบุ:</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-10">
                            <input class="form-control"  name="rg_want_other" type="text" id="rg_want_other"  value="<?= $array_edit[rg_want_other] ?>" <?= $read ?>/>	
                        </div> 
                    </div>
                        <div class="form-group col-sm-12">
                            <label>รายละเอียดเพื่มเติม</label>
                            <textarea class="form-control"  rows="2" id="rg_detail" placeholder="กรุณากรอกข้อมูล" name="rg_detail" <?= $read ?>><?=$array_edit[rg_detail]?></textarea>
                        </div> 
                </div>
                </div>
                    <center>
                        <a class="btn btn-info" onclick="window.history.back()">ย้อนกลับ</a>
                        <a class="btn btn-default" href="RequestGeneral_print.php?rg_id=<?= $array_edit[rg_id] ?>" target="_blank">พิมพ์</a>	
                    </center>


                </div>


            </div>
        </div>
    </body>

</html>
