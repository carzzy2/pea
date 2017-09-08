<?php
@session_start();
include "connect_db.php";
$ses_userid =$_SESSION[ses_userid];
$ses_username = $_SESSION[loginid];
	if($ses_userid <> session_id() or $ses_username ==""){
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
<?php include "header.php";?>

<?php
    include"sidebar.php"; 
?>
 <?php
        $read="required";
?>
    <div id="page-wrapper">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">คำร้องทั่วไป</h2>
                </div>
            <div class="panel-body">

            <form method="post" action="RequestGeneral_part2.php" >
                <?php
                    $new_id =mysql_result(mysql_query("Select Max(substr(rg_id,-4))+1 as MaxID from tb_general "),0,"MaxID" );
                    if($new_id==''){
                        $rg_id="110000000001";
                    }else{
                        $rg_id="11".sprintf("%010d",$new_id);
                    }
                ?>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>เลขที่คำร้อง</label>
                        <input class="form-control" autocomplete=off  name="rg_id" type="text" id="rg_id" value="<?=$rg_id?>" size="30" readonly/>
                        <input  type="hidden" class="form-control "  name="rg_id" id="rg_id" value="<?=$rg_id?>">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>กฟฟ(สาขา).</label>
                            <select class="form-control" name="rg_branch" id="rg_branch" required/>
                                    <option style="display: none">--กรุณาเลือก--</option>
                                    <option value="มะลิวัลย์" >มะลิวัลย์</option>
                                    <option value="ท่าพระ" >ท่าพระ</option>
                                    <option value="พระยืน" >พระยืน</option>
                            </select>	
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>เจ้าหน้าที่ผู้รับคำร้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="user_id" type="text" id="user_id" value="<?=$user[user_name]?> <?=$user[user_last]?>" readonly/>	
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>วัน/เดือน/ปี</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_date" type="text" id="rg_date" value="<?=date("d/m/").(date("Y")+543)?>"  readonly/>	
                        </div>
                    </div>
                    <div class="row ">
                        <label>1.ชื่อผู้ใช้ไฟฟ้า/ลูกค้า</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>คำนำหน้า</label>
                                <select id="cus_first" class="form-control" name="cus_first" <?=$read?>>
                                    <option style="display: none">--กรุณาเลือก--</option>
                                    <option value="0" <?php if($array_edit['cus_first']=="0"){ echo "selected=selected"; }?>>นาย</option>
                                    <option value="1" <?php if($array_edit['cus_first']=="1"){ echo "selected=selected"; }?>>นาง</option>
                                    <option value="2" <?php if($array_edit['cus_first']=="2"){ echo "selected=selected"; }?>>นางสาว</option>
                                </select>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>ชื่อ-นามสกุล</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_name" type="text" id="cus_name" value="<?=$array_edit[cus_name]?>"  <?=$read?>>	
                        </div>
                        <div class="col-sm-5 form-group">
                            <label>ประเภทบัตร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_type" type="text" id="cus_type" value="<?=$array_edit[cus_type]?>"  <?=$read?>>	
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>รหัสประชาชน </label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" autocomplete=off  name="cus_id" type="text" id="cus_id" value="<?=$array_edit[cus_id]?>" size="30"  onkeyup="IsNumeric(this.value,this)" maxlength="13" required/>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>หมายเลขประจำตัวผู้เสียภาษีอากร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_tax" type="text" id="cus_tax" value="<?=$array_edit[cus_tax]?>" <?=$read?>>	
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>หมายเลขผู้ใช้ไฟฟ้า</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_code" type="text" id="cus_code" value="<?=$array_edit[cus_code]?>" <?=$read?>>	
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_homeid" type="text" id="cus_homeid" value="<?=$array_edit[cus_homeid]?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_number" type="text" id="cus_number" value="<?=$array_edit[cus_number]?>"<?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_village" type="text" id="cus_village" value="<?=$array_edit[cus_village]?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_room" type="text" id="cus_room" value="<?=$array_edit[cus_room]?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_floor" type="text" id="cus_floor" value="<?=$array_edit[cus_floor]?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_alley" type="text" id="cus_alley" value="<?=$array_edit[cus_alley]?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_alleyway" type="text" id="cus_alleyway" value="<?=$array_edit[cus_alleyway]?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_road" type="text" id="cus_road" value="<?=$array_edit[cus_road]?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_vilno" type="text" id="cus_vilno" value="<?=$array_edit[cus_vilno]?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_district" type="text" id="cus_district" value="<?=$array_edit[cus_district]?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_canton" type="text" id="cus_canton" value="<?=$array_edit[cus_canton]?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_province" type="text" id="cus_province" value="<?=$array_edit[cus_province]?>"<?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_post" type="text" id="cus_post" value="<?=$array_edit[cus_post]?>"  maxlength="5" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_tel" type="text" id="cus_tel" value="<?=$array_edit[cus_tel]?>"  maxlength="10"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_fax" type="text" id="cus_fax" value="<?=$array_edit[cus_fax]?>"  maxlength="10" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_email" type="text" id="cus_email" value="<?=$array_edit[cus_email]?>" <?=$read?>>
                        </div>
                    </div>
                    <center>
                        <input  type="hidden" class="form-control " name="newcus" id="add" value="addcus">
                        <a class="btn btn-info" onclick="window.history.back()"><i class="fa fa-arrow-left"> ย้อนกลับ</i></a>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-arrow-right"> ถัดไป</i></button>	
                    </center>
                </div>
            </form> 
        </div>

				
            </div>
        </div>
</body>

</html>
