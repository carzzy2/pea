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
                        <h2 class="panel-title">รายงานคำร้องขอใช้ไฟฟ้า</h2>
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
                                <div class="clearfix"></div><br>
                                <div class="form-group">
                                    <select  class="form-control" name="status" >
                                        <option value="10" <?php if($_GET[status]=="10"){ echo "selected";} ?>>ทั้งหมด</option>
                                        <option value="0" <?php if($_GET[status]=="0"){ echo "selected";} ?>>ยังไม่ได้สำรวจ</option>
                                        <option value="9" <?php if($_GET[status]=="9"){ echo "selected";} ?>>ไม่ผ่านการสำรวจ</option>
                                        <option value="1" <?php if($_GET[status]=="1"){ echo "selected";} ?>>ผ่านการสำรวจแล้ว</option>
                                        <option value="2" <?php if($_GET[status]=="2"){ echo "selected";} ?>>ชำระค่าธรรมเนียมแล้ว</option>
                                        <option value="3" <?php if($_GET[status]=="3"){ echo "selected";} ?>>บันทึกการปฎิบัติงานแล้ว</option>
                                        <option value="4" <?php if($_GET[status]=="4"){ echo "selected";} ?>>ไม่ผ่านการตรวจสอบมาตรฐาน</option>
                                        <option value="6" <?php if($_GET[status]=="6"){ echo "selected";} ?>>เสร็จสิ้น</option>
                                    </select>
                                    </div>
                            </form>
                        </div>
                        <?php
                        if($_GET['txtdate1']!='' and $_GET['txtdate2']!=''){
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="pull-right">
                                        <a  class="btn btn-info" target="_blank"  href="report_Electricity_print.php?date1=<?=$_GET['txtdate1']?>&date2=<?=$_GET['txtdate2']?>&status=<?=$_GET[status]?>" >Print</a>
                                    </div>
                                </div>
                            <div class="clearfix"></div><br>
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                        <table width="100%" class="table table-bordered table-hover">
                                            <thead>               
                                                <tr>
                                                    <th class=" text-center" >ลำดับ</th>
                                                    <th class=" text-center" >รหัสใบคำร้อง</th>
                                                    <th class=" text-center" >วันที่บันทึก</th>
                                                    <th class=" text-center" >รายการ</th>
                                                    <th class=" text-center" >ลูกค้า</th>
                                                    <th class=" text-center" style="min-width: 200">สถานะ</th>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php
                                                $n = 0;
                                                if($_GET['status']==0){
                                                    $re_status="and re_status='0'";
                                                }elseif($_GET['status']==1){
                                                    $re_status="and re_status='1'";
                                                }elseif($_GET['status']==2){
                                                    $re_status="and re_status='2'";
                                                }elseif($_GET['status']==3){
                                                    $re_status="and re_status='3'";
                                                }elseif($_GET['status']==4){
                                                    $re_status="and re_status='4'";
                                                }elseif($_GET['status']==6){
                                                    $re_status="and re_status='6'";
                                                }elseif($_GET['status']==9){
                                                    $re_status="and re_status='9'";
                                                }else{
                                                    $re_status="";
                                                }
                                                $sql = "select * from tb_electricity where re_date between '".$_GET[txtdate1]."' and '".$_GET[txtdate2]."' $re_status order by re_id asc";
                                                $result = mysql_db_query($dbname, $sql);
                                                $num=mysql_num_rows($result);
                                                if (mysql_num_rows($result) > 0) {
                                                    while ($array = mysql_fetch_array($result)) {
                                                        $page++;
                                                        $sqlcus = "select * from tb_customer where cus_id='" . $array[cus_id] . "'";
                                                        $resultcus = mysql_db_query($dbname, $sqlcus);
                                                        $arraycus = mysql_fetch_array($resultcus);

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
                                                        } elseif ($array[re_want_type] == 15) {
                                                            $want = "ขอใช้ไฟฟ้าตู้โทรศัพท์ต่อตรง";
                                                        } elseif ($array[re_want_type] == 16) {
                                                            $want = $array[re_place_other];
                                                        }
                                                        if ($array[re_status] == 0) {
                                                            $label = "ยังไม่ได้สำรวจ";
                                                            $status = "#848480";
                                                        } elseif ($array[re_status] == 1) {
                                                            $status = "#5bc0de";
                                                            $label = "ผ่านการสำรวจแล้ว";
                                                        } elseif ($array[re_status] == 2) {
                                                            $status = "#F78234";
                                                            $label = "ชำระค่าธรรมเนียมแล้ว";
                                                        } elseif ($array[re_status] == 3) {
                                                            $status = "#99cc00";
                                                            $label = "บันทึกการปฎิบัติงานแล้ว";
                                                        } elseif ($array[re_status] == 4) {
                                                            $status = "#16DD87";
                                                            $label = "ไม่ผ่านการตรวจสอบมาตรฐาน,รอแก้ไข";
                                                        } elseif ($array[re_status] == 5) {
                                                            $status = "#751C90";
                                                            $label = "ไม่ผ่านการตรวจสอบมาตรฐาน,รอตรวจสอบใหม่";
                                                        } elseif ($array[re_status] == 6) {
                                                            $status = "#2E9AFE";
                                                            $label = "เสร็จสิ้น";
                                                        } elseif ($array[re_status] == 9) {
                                                            $status = "#d9534f";
                                                            $label = "ไม่ผ่านการสำรวจ";
                                                        }
                                                        ?>	
                                                        <tr>
                                                            <td class="text-center"><?= $page ?></td>
                                                            <td class=" text-center"><?= $array[re_id] ?></td>
                                                            <td class=" text-center"><?= Dateim($array[re_date]); ?></td>
                                                            <td class=" text-center"><?= $want ?></td>
                                                            <td class="text-center"><?= $arraycus[cus_name] ?></td>
                                                            <td class="text-center"><?= $label ?></td>
                                                        </tr>
                                                        
                                                        <?php
                                                    }
                                                    
                                                    ?>
                                                        <tr>
                                                        <td class="text-right" colspan="5"><b>รวมทั้งสิ้น</b></td>
                                                        <td class="text-right"><?= $num ?> รายการ</td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    ?>				  
                                                    <tr><td colspan="6" align="center">ไม่พบข้อมูล</td></tr>
                                                    <?
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
