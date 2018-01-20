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
<?php include "header.php";
?>

<?php
    include"sidebar.php"; 
?>
 <?php
 function Dateim($mydate){
    $d=split("-",$mydate);
    $mydate=$d[2]."/".$d[1]."/".($d[0]+543);
    return "$mydate";
}
    $sql="select * from tb_electricity ele,tb_customer cus,tb_user user where re_id='".$_GET[id]."' and ele.cus_id=cus.cus_id and ele.user_id=user.user_id";
    $result=mysql_db_query($dbname,$sql);
    $array=mysql_fetch_array($result);
?>
    <div id="page-wrapper">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="panel-title">อนุมัติการสำรวจหน้างานเลขที่ <?= $_GET[id] ?></h2>
            </div>
            <div class="panel-body">
                <form method="post" action="StatusElectricity_save">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>เลขที่คำร้อง</label>
                                <input class="form-control" autocomplete=off  name="re_id" type="text" id="re_id" value="<?= $_GET[id] ?>" size="30" readonly/>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>กฟฟ(สาขา).</label>
                                <input  type="text" class="form-control"  value="<?= $array['re_branch'] ?>" readonly>		
                            </div>
                            
                            <div class="col-sm-3 form-group">
                                <label>วัน/เดือน/ปี</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_date" type="text" id="re_date" value="<?= Dateim($array[re_date]);?>"  readonly/>	
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>เจ้าหน้าที่ที่สำรวจ</label>
                                <select id="user_id" class="form-control" name="user_id" required>
                                    <option value=""><-- เลือกเจ้าหน้าที่สำรวจ --></option>
                                    <?php
                                    $strSQL = "SELECT * FROM tb_user where user_pos='1' ";
                                    $objQuery = mysql_query($strSQL);
                                    while ($objResult = mysql_fetch_array($objQuery)) {
                                        ?>
                                        <option value="<?= $objResult['user_id']; ?>" ><?= $objResult['user_id']; ?> <?php echo $objResult['user_name']; ?> <?php echo $objResult['user_last']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label>อุปกรณ์ที่ใช้ติดตั้ง</label>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>(1) หม้อแปลง</label>
                                    <div class="form-group">
                                        <select id="equ_tran" class="form-control" name="equ_tran" required>
                                            <option value=""><-- เลือกขนาดหม้อแปลง --></option>
                                            <option value="1 เฟส ขนาด 30 KVA"> 1 เฟส ขนาด 30 KVA</option>
                                            <option value="3 เฟส ขนาด 50 KVA">3 เฟส ขนาด 50 KVA</option>
                                            <option value="3 เฟส ขนาด 100 KVA"> 3 เฟส ขนาด 100 KVA</option>
                                            <option value="3 เฟส ขนาด 160 KVA"> 3 เฟส ขนาด 160 KVA</option>
                                            <option value="3 เฟส ขนาด 250 KVA"> 3 เฟส ขนาด 250 KVA</option>
                                            <option value="3 เฟส ขนาด 315 KVA"> 3 เฟส ขนาด 315 KVA</option>
                                            <option value="3 เฟส ขนาด 400 KVA"> 3 เฟส ขนาด 400 KVA</option>
                                            <option value="3 เฟส ขนาด 500 KVA"> 3 เฟส ขนาด 500 KVA</option>
                                            <option value="3 เฟส ขนาด 1000 KVA"> 3 เฟส ขนาด 1000 KVA</option>
                                            <option value="3 เฟส ขนาด 1250 KVA"> 3 เฟส ขนาด 1250 KVA</option>
                                            <option value="3 เฟส ขนาด 2000 KVA"> 3 เฟส ขนาด 2000 KVA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>จำนวน</label>
                                    <div class="form-group input-group">
                                        <input type="number" class="form-control" name="equ_tran_unit" min="0"  required>
                                        <span class="input-group-addon">เครื่อง</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>(2) เครื่องปรับอากาศ</label>
                                    <div class="form-group">
                                        <select id="equ_air" class="form-control" name="equ_air" required>
                                            <option value=""><-- เลือกขนาดเครื่องปรับอากาศ --></option>
                                            <option value="12,000 บีทียู">12,000 บีทียู</option>
                                            <option value="15,300 บีทียู">15,300 บีทียู</option>
                                            <option value="18,000 บีทียู">18,000 บีทียู</option>
                                            <option value="20,800 บีทียู">20,800 บีทียู</option>
                                            <option value="22,800 บีทียู">22,800 บีทียู</option>
                                            <option value="27,200 บีทียู">27,200 บีทียู</option>
                                            <option value="32,800 บีทียู">32,800 บีทียู</option>
                                            <option value="38,000 บีทียู">38,000 บีทียู</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>จำนวน</label>
                                    <div class="form-group input-group">
                                        <input type="number" class="form-control" name="equ_air_unit" min="0" required>
                                        <span class="input-group-addon">เครื่อง</span>
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
                                            $sqlmeter = "SELECT * FROM tb_meter where me_type='".$array['re_want_type']."' ";
                                            $querrymeter = mysql_query($sqlmeter);
                                            while ($arraymeter = mysql_fetch_array($querrymeter)) {
                                                ?>
                                                <option value="<?= $arraymeter['me_id']; ?>" ><?= $arraymeter['me_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div><input type="hidden"  name="equ_meter_unit"value="1" >
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
                        <center>
                            <input type="hidden" name="typestatus" value="pass" >
                            <a class="btn btn-info" onclick="location.href='StatusElectricity.php'"> ย้อนกลับ</a>
                            <button class="btn  btn-success" name="Submit" type="submit" value="1">บันทึก</button>                            
                        </center>
                    </div>
                </form> 
            </div>


        </div>
    </div>
</body>

</html>
