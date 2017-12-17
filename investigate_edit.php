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
            $igid = "160000000001";
        } else {
            $igid = "16" . sprintf("%010d", $new_id);
        }
        $sql="select * from tb_investigate where re_id='".$_GET[id]."' and ig_install='2' order by ig_id asc LIMIT 1 ";
        $result=mysql_db_query($dbname,$sql);
        $array=mysql_fetch_array($result);
        ?>
        <div id="page-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">ตรวจสอบมาตรฐาน</h2>
                </div>
                <div class="panel-body">
                    
                    <form method="post" action="investigate_save.php" class="form-inline">
                        <div class="col-sm-12">
                            <div class="row">

                                <div class=" form-group">
                                    <label>รหัสตรวจสอบ</label>
                                    <input class="form-control" autocomplete=off  name="ig_id" type="text" id="ig_id" value="<?= $igid ?>" size="30" readonly/>
                                </div>
                                <div class=" form-group">
                                    <label>วัน/เดือน/ปี</label>
                                    <input class="form-control" name="user_id" type="text" id="re_date" value="<?= date("d/m/") . (date("Y") + 543) ?>"  readonly/>	
                                </div>
                                <div class=" form-group">
                                    <label>เจ้าหน้าที่ลงบันทึก</label>
                                    <input class="form-control"  type="text"  value="<?=$user['user_name']?> <?=$user['user_last']?>"  readonly/>
                                    <input name="user_id" type="hidden" id="finish" value="<?=$user['user_id']?>" >
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <label>รายงานและความเห็นของผู้ตรวจสอบ</label>
                                        </div>
                                    </div>    
                                    <div class="row">
                                        <div class="form-group ">
                                            <label>1. สายแม่แรงต่ำ ขนาด</label>
                                            <div class="form-group input-group">
                                                <input type="text" class="form-control" name="ig_lowtension" value="<?=$array['ig_lowtension']?>"  readonly>
                                                <span class="input-group-addon">ตร.มม</span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label>จำนวน</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="ig_lowtension_amount" min="0" value="<?=$array[ig_lowtension]?>"  readonly>
                                                <span class="input-group-addon">เฟส</span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="ig_lowtension_line" min="0" value="<?=$array['ig_lowtension']?>" readonly>
                                                <span class="input-group-addon">สาย</span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group ">
                                            <label>2. จ่ายไฟจากสถานไฟฟ้าย่อย</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_power" value="<?=$array['ig_lowtension']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ฟีดเดอร์แรงสูง</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_power_speed"  value="<?=$array['ig_lowtension']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ปีจัดซื้อ(ตาม มป.5)</label>
                                            <div class="form-group">
                                                <select id="equ_tran" class="form-control" name="ig_power_year" disabled>
                                                    <option value=""><-- เลือกปี --></option>
                                                    <option value="2560"<?php if($array[ig_power_year]=="2560"){ echo "selected";} ?>>2560</option>
                                                    <option value="2559" <?php if($array[ig_power_year]=="2559"){ echo "selected";} ?>>2559</option>
                                                    <option value="2558" <?php if($array[ig_power_year]=="2558"){ echo "selected";} ?>>2558</option>
                                                    <option value="2557" <?php if($array[ig_power_year]=="2557"){ echo "selected";} ?>>2557</option>
                                                    <option value="2556" <?php if($array[ig_power_year]=="2556"){ echo "selected";} ?>>2556</option>
                                                    <option value="2555" <?php if($array[ig_power_year]=="2555"){ echo "selected";} ?>>2555</option>
                                                    <option value="2554" <?php if($array[ig_power_year]=="2554"){ echo "selected";} ?>>2554</option>
                                                    <option value="2553" <?php if($array[ig_power_year]=="2553"){ echo "selected";} ?>>2553</option>
                                                    <option value="2552" <?php if($array[ig_power_year]=="2552"){ echo "selected";} ?>>2552</option>
                                                    <option value="2551" <?php if($array[ig_power_year]=="2551"){ echo "selected";} ?>>2551</option>
                                                    <option value="2550" <?php if($array[ig_power_year]=="2550"){ echo "selected";} ?>>2550</option>
                                                </select>
                                            </div><input type="hidden"  name="ig_power_year" value="<?=$array[ig_power_year]?>" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="radio">
                                                <label><input name="ig_lowpower" size="30" type="radio" value="1" id="ig_lowpower1" <?php if($array[ig_lowpower]=="1"){ echo "checked";} ?> disabled>ฟิดเดอร์แรงต่ำ</label>
                                                <label><input name="ig_lowpower" size="30" type="radio" value="2" id="ig_lowpower2" <?php if($array[ig_lowpower]=="2"){ echo "checked";} ?> disabled>เฟสแรงต่ำ</label>
                                            </div><input type="hidden"  name="ig_lowpower" value="<?=$array[ig_lowpower]?>" >
                                        </div>
                                        <div class="form-group ">
                                            <label>ชนิดของหม้อแปลง</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control"  name="ig_lowpower_type" value="<?=$array['ig_lowtension']?>" readonly>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label>หมายเลขหม้อแปลง</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control"  name="ig_lowpower_number" value="<?=$array['ig_lowpower_number']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>หม้อแปลงขนาด</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" value="<?=$array['ig_outlet']?>" name="ig_outlet"  readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label>3.ความเห็นของผู้ตรวจสอบ</label>
                                        </div>
                                    </div>   <br> 
                                    <div class="row">
                                        <div class="form-group">
                                            <label >ประเภทกิจการ</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_bstype" value="<?=$array['ig_bstype']?>"  readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label >ติดตั้งมิเตอร์ขนาด</label>
                                            <div class="form-group input-group">
                                                <input type="text" class="form-control" name="ig_meter"   required>
                                                <span class="input-group-addon">แอมป์</span>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >เฟส</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_meter_phase"   required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >โวลท์</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_meter_volt"   required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                   
                                        <div class="form-group">
                                            <label >สายคิดค่าไฟฟ้าประเภท</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_linetype"   required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label >แรงดัน</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_linetype_pressure"   required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >โวลท์</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_linetype_volt"   required>
                                            </div>
                                        </div>
                                         
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label >ติดตั้งซีทีขนาด</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" name="ig_ct"   required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label >วีทีขนาด</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_vt"   required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >เควาร์ขนาด</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_kwa"   required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label >หมายเลข PEA. มิเตอร์ก่อนหน้า(สายการจดหน่วยเดียวกัน)</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" name="ig_number_bf"   required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label >หมายเลข PEA. มิเตอร์ถัดไป(สายการจดหน่วยเดียวกัน)</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" name="ig_number_af"   required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label >สายการจดหน่วย</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" name="ig_linepoint"   required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >หมายเลข PEA.มิเตอร์</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" name="ig_linenumber"   required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                            <div class="form-group">
                                                <label>ผลการแก้ไข</label>
                                            </div>
                                        </div>
                                    <div class="row">
                                         
                                        <div class="form-group col-md-12">
                                            <div class="radio">
                                                <label><input name="ig_install" size="30" type="radio" value="1" id="ig_install1">เรียบร้อย</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="radio">
                                                <label><input name="ig_install" size="30" type="radio" value="2" id="ig_install2">แก้ไข</label>
                                            </div>
                                            <div class="form-group ">
                                                <input type="text" class="form-control"  name="ig_install_other1" id="ig_install_other1" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                            <center>
                                <a class="btn btn-info" onclick="location.href = 'investigate_show.php'"> ย้อนกลับ</a>
                                <input class="btn btn-success" name="finish" type="submit" id="finish" value="บันทึก" >
                                <input  name="re_id" type="hidden"  value="<?=$_GET[id]?>" >  
                            </center>
                        </div>
                    </form> 
                </div>

<script type="text/javascript">
$(document).ready(function() {
$("#ig_install1").attr('checked', true);
$("#ig_install_other1").attr('readonly', true);
$("#ig_install_other2").attr('readonly', true);

$("#ig_install2").click(function(){
    $("#ig_install_other1").attr('readonly', false);
    $("#ig_install_other2").attr('readonly', true);
    $("#ig_install_other2").val('');
});
$("#ig_install3").click(function(){
    $("#ig_install_other1").attr('readonly', true);
    $("#ig_install_other2").attr('readonly', false);
    $("#ig_install_other1").val('');
});
$("#ig_install1").click(function(){
    $("#ig_install_other1").attr('readonly', true);
    $("#ig_install_other2").attr('readonly', true);
    $("#ig_install_other1").val('');
    $("#ig_install_other2").val('');
});

});
</script>
            </div>
        </div>
    </body>

</html>
