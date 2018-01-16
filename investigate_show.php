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

function getlistname($want_type, $other) {
    if ($want_type == 0) {
        $want = "ขอติดตั้งมิเตอร์ใหม่";
    } elseif ($want_type == 1) {
        $want = "ขอตัดฝากมิเตอร์โดยไม่ใช้ไฟฟ้า";
    } elseif ($want_type == 2) {
        $want = "ขอต่อกลับการใช้ไฟฟ้า";
    } elseif ($want_type == 3) {
        $want = "ขอเพื่มขนาดมิเตอร์/อุปกรณ์ประกอบ";
    } elseif ($want_type == 4) {
        $want = "ขอเปลี่ยนประเภทมิเตอร์";
    } elseif ($want_type == 5) {
        $want = "ขอหยุดซ่อมแซมเครื่องจักรประจำปี";
    } elseif ($want_type == 6) {
        $want = "ขอใช้ไฟฟ้าชั่วคราวแบบเหมาจ่าย";
    } elseif ($want_type == 7) {
        $want = "ขอติดตั้งไฟฟ้าชั่วคราว";
    } elseif ($want_type == 8) {
        $want = "ขอตัดฝากมิเตอร์ใช้เพื่อแสงสว่างไม่ลด CT";
    } elseif ($want_type == 9) {
        $want = "ขอยกเลิกเลิกการใช้ไฟฟ้า";
    } elseif ($want_type == 10) {
        $want = "ชอลดขนาดมิเตอร์/อุปกรณ์ประกอบ";
    } elseif ($want_type == 11) {
        $want = "ขอใช้ไฟฟ้าสาธารณะ";
    } elseif ($want_type == 12) {
        $want = "ขอตัดมิเตอร์ใช้เพื่อแสงสว่างลด CT";
    } elseif ($want_type == 13) {
        $want = "ขอย้ายจุดติดตั้งมิเตอร์/อุปกรณ์ประกอบ";
    } elseif ($want_type == 14) {
        $want = "ขอเปลี่ยนมิเตอร์กรณีชำรุด";
    } elseif ($want_type == 15) {
        $want = "ขอใช้ไฟฟ้าตู้โทรศัพท์ต่อตรง";
    } elseif ($want_type == 16) {
        $want = $other;
    }
    return $want;
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
        <?php include "header.php"; ?>
        <?php
        include"sidebar.php";
        ?>
        <div id="page-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">ตรวจสอบมาตรฐานการดำเนินงาน</h2>
                </div>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <form name="frmSearch" method="POST">
                                <div class="form-group input-group">
                                    <input type="search" name="search" class="form-control" placeholder="ค้นหา">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info" type="submit" style="height:34px;"><i class="fa fa-search"></i></button>
                                    </span>
                                </div> 
                            </form>
                        </div>
                        <div class="col-sm-12">    
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered table-hover">
                                    <thead>               
                                        <tr>
                                            <th class=" text-center" >ลำดับ</th>
                                            <th class=" text-center">ดูรายละเอียด</th>
                                            <th class=" text-center" >รหัสใบคำร้อง</th>
                                            <th class=" text-center" >วันที่บันทึก</th>
                                            <th class=" text-center" >รายการ</th>
                                            <th class=" text-center" >ลูกค้า</th>
                                            <th class=" text-center" >สถานะ</th>
                                            <th class=" text-center">จัดการข้อมูล</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                        $page = 0;
                                        $sql = "select * from tb_electricity where re_status in (3,4,5) and re_id like '%" . $_POST[search] . "%'  order by re_id desc";
                                        $result = mysql_db_query($dbname, $sql);
                                        if (mysql_num_rows($result) > 0) {
                                            while ($array = mysql_fetch_array($result)) {
                                                
                                                $sqlcus = "select * from tb_customer where cus_id='" . $array[cus_id] . "'";
                                                $resultcus = mysql_db_query($dbname, $sqlcus);
                                                $arraycus = mysql_fetch_array($resultcus);

                                                if ($array[re_status] == "5") {
                                                    $status = "รอการแก้ไข";
                                                    $label = "danger";
                                                } elseif ($array[re_status] == "4") {
                                                    $status = "ไม่ผ่านการตรวจสอบ";
                                                    $label = "warning";
                                                } else {
                                                    $status = "รอตรวจสอบ";
                                                    $label = "info";
                                                }
                                                $wanttype = getlistname($array[re_want_type], $array[re_place_other]);
                                                    $page++;
                                                ?>	
                                                <tr>
                                                    <td class="text-center"><?= $page ?></td>
                                                    <td><a class="btn btn-default" href="investigate_view.php?id=<?= $array[re_id] ?>">ดูรายละเอียด</a></td>
                                                    <td class=" text-center"><?= $array[re_id] ?></td>
                                                    <td class=" text-center"><?= Dateim($array[re_date]); ?></td>
                                                    <td class=" text-center"><?= $wanttype ?></td>
                                                    <td class="text-center"><?= $arraycus[cus_name] ?></td>
                                                    <td class="text-center"><span class="label label-<?= $label ?>"><?= $status ?></span></td>
                                                    <td>
                                                        <div  align="center">
                                                                <?php if($array[re_status]=="3"){ ?>
                                                                    <a class="btn btn-default" href="investigate_add.php?id=<?= $array[re_id] ?>"><i class="fa fa-check"> ดำเนินการตรวจสอบ</i></a>
                                                                <?php }elseif ($array[re_status]=="4"){ ?>                                                       
                                                                    <a class="btn btn-default" href="investigate_add.php?id=<?= $array[re_id] ?>"><i class="fa fa-check"> แก้ไข</i></a>
                                                                <?php }elseif ($array[re_status]=="5"){ ?>
                                                                    <a class="btn btn-default" href="investigate_add.php?id=<?= $array[re_id] ?>"><i class="fa fa-check"> ตรวจสอบใหม่</i></a>
                                                                <?php } ?>
                                                                    </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            
                                            }
                                        } else {
                                            ?>				  
                                            <tr><td colspan="7" align="center">ไม่พบข้อมูล</td></tr>
                                            <?php
                                        }
                                        ?>	
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </body>

</html>
