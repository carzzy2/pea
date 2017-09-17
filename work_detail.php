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
        $sql = "select * from tb_work where work_id='" . $_GET[work_id] . "'";
        $result = mysql_db_query($dbname, $sql);
        $array_show = mysql_fetch_array($result);
        
        ?>
        <div id="page-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">บันทึกการปฎิบัติงานเลขที่<?=$array_show[work_id]?></h2>
                </div>
                <div class="panel-body">
                    <form method="post" action="work_cal.php">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label>รหัสการปฎิบัติงาน</label>
                                    <input class="form-control" autocomplete=off  name="fee_id" type="text" id="fee_id" value="<?=$array_show[work_id]?>" size="30" readonly/>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>วัน/เดือน/ปี</label>
                                    <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_date" type="text" id="re_date" value="<?= Dateim($array_show[work_date]); ?>"  readonly/>	
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>เลขที่คำร้องขอใช้ไฟฟ้า</label>
                                    <select id="re_id" class="form-control" name="re_id" OnChange="window.location = 'work_addreid?re_id=' + this.value;" disabled>
                                        <option value=""><-- เลือกเลขที่คำร้องขอใช้ไฟฟ้า --></option>
                                        <?php
                                        $strSQL = "SELECT * FROM tb_electricity where re_status='1' ORDER BY re_id ASC";
                                        $objQuery = mysql_query($strSQL);
                                        while ($objResult = mysql_fetch_array($objQuery)) {
                                            if ($array_show[re_id] == $objResult["re_id"]) {
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
                            if ($array_show[re_id] != "") {
                                    $sql = "select * from tb_electricity ele,tb_customer cus where re_id='" . $array_show[re_id]. "' and ele.cus_id=cus.cus_id";
                                    $result = mysql_db_query($dbname, $sql);
                                    $array = mysql_fetch_array($result);
                                ?>
                            <div class="row">
                                
                           
                            <div class="col-md-12">
                                <table  class="table table-bordered table-hover">
                                    <thead>               
                                        <tr>             
                                            <th class="text-center" width="150px">รหัสเจ้าหน้าที่</th>
                                            <th class="text-center" width="400px">ชื่อเจ้าหน้าที่</th>
                                            <th class="text-center">หน้าที่</th>
                                        </tr> 
                                    </thead>
                            <?php
                                $n=0;
                                $sql_detail="select * from tb_work_detail,tb_user where work_id='".$array_show[work_id]."' and tb_work_detail.user_id=tb_user.user_id";
                                $result_detail=mysql_db_query($dbname,$sql_detail);
                                        while($array_detail=mysql_fetch_array($result_detail)){
                                                $n++;
                            ?>
                            <tbody>	
                                <tr>    
                                    <td>&nbsp;<?=$array_detail[user_id]?></td>
                                    <td>คุณ<?=$array_detail[user_name]?> <?=$array_detail[user_last]?></td>
                                    <td align="right"><textarea name="work_detail[]" cols="20" class="form-control" placeholder="ระบุหน้าที่" disabled><?=$array_detail[work_detail]?></textarea></td>
                                </tr>
                                <?php
                                }
                                ?>
                            <?php } ?>
                            </tbody>
                                </table>
                                </div>
                                 </div>
                            <div class="row">
                                <center>
                                <input type="hidden" name="fee_price" value="<?=$total?>" >
                                <a class="btn btn-info" onclick="location.href = 'work_show.php'"> ย้อนกลับ</a>                     
                            </center>
                            </div>
                            
                        </div>
                    </form> 
                </div>


            </div>
        </div>
    </body>

</html>
