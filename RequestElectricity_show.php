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

</head>

<body>
<?php include "header.php";?>

<?php
    include"sidebar.php"; 
?>
    <div id="page-wrapper">
        <div class="col-sm-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">คำร้องขอใช้ไฟฟ้า</h2>
                </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="RequestElectricity.php"><input type="button" value="เพิ่มข้อมูล" class="btn  btn-success"></a>
                    </div>
                    <div class="col-sm-4">
                        <form name="frmSearch" method="POST">
                            <div class="form-group input-group">
                                <input type="search" name="search" class="form-control" placeholder="ค้นหาข้อมูล">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit" style="height:34px;"><i class="fa fa-search"></i></button>
                                </span>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="col-md-1" style="background-color: #848480; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span class="col-md-2">ยังไม่ได้สำรวจ</span>
                        
                        <span class="col-md-1" style="background-color: #d9534f; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span class="col-md-2">ไม่ผ่านการสำรวจ</span>
                        
                        <span class="col-md-1" style="background-color: #5bc0de; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span class="col-md-2">ผ่านการสำรวจแล้ว</span>
                        
                        <span class="col-md-1" style="background-color: #F78234; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span class="col-md-2">ชำระค่าธรรมเนียมแล้ว</span>
                        <br><br>
                        <span class="col-md-1" style="background-color: #99cc00; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span class="col-md-2">บันทึกการปฎิบัติงานแล้ว</span> 
                        
                        <span  class="col-md-1" style="background-color: #16DD87; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span class="col-md-2">ผ่านการตรวจสอบมาตรฐาน</span>  
                        
                        <span  class="col-md-1" style="background-color: #751C90; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span class="col-md-2">ไม่ผ่านการตรวจสอบมาตรฐาน</span> 
                        
                        <span class="col-md-1" style="background-color: #2E9AFE; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span class="col-md-2">เสร็จสิ้น</span> 
                    </div>
                </div>
                <br>
            <div class="col-sm-12">
                <div class="table-responsive">
                    <?php
                        $sql_all_rows="select * from tb_electricity order by re_id";
                        $result_all_rows=mysql_db_query($dbname,$sql_all_rows);
                        $rows=mysql_num_rows($result_all_rows);
                        echo $row;
                        $total_page=ceil($rows/$limit);
                        if($_GET[start]==""){ $start="1"; }else{ $start=$_GET[start]; }
                    ?>	
                    <?php
                    for($i=1;$i<=$total_page;$i++){
                            if($start==$i){
                                    echo "<a href='RequestElectricity_show.php?start=".$i."&limit=".$limit."'><button class='btn btn-default '>".$i."</button></a>&nbsp;";
                            }else{
                                    echo "<a href='RequestElectricity_show.php?start=".$i."&limit=".$limit."' c><button class='btn btn-default active'>".$i."</button></a>&nbsp;";
                            }

                    }
                    ?> <br><br>
                    <table width="100%" class="table table-bordered table-hover">
                        <thead>               
                            <tr>
                                <th class=" text-center" >ลำดับ</th>
                                <th class=" text-center" >รหัสใบคำร้อง</th>
                                <th class=" text-center" >วันที่บันทึก</th>
                                <th class=" text-center" >รายการ</th>
                                <th class=" text-center" >ลูกค้า</th>
                                <th class=" text-center" style="min-width: 200">สถานะ</th>
                                <th class=" text-center">จัดการข้อมูล</th>
                            </tr> 
                        </thead>
                            <tbody>
                            <?php
                                $n=0;
                                if($_GET[start]=="" || $_GET[start]=="1"){ 
                                        $page="0"; 
                                }else{
                                        $page=($_GET[start]-1)*$limit; 
                                }
                                $sql="select * from tb_electricity where re_id like '%".$_POST[search]."%' order by re_id desc limit $page,$limit";
                                $result=mysql_db_query($dbname,$sql);
                                    if(mysql_num_rows($result)>0){
                                        while($array=mysql_fetch_array($result)){
                                            $page++;
                                            $sqlcus="select * from tb_customer where cus_id='".$array[cus_id]."'";
                                            $resultcus=mysql_db_query($dbname,$sqlcus);
                                            $arraycus=mysql_fetch_array($resultcus);
                                            
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
                                            if($array[re_status]==0){
                                                $label="ยังไม่ได้สำรวจ";
                                                $status="#848480";
                                            }elseif($array[re_status]==1){
                                               $status="#5bc0de";
                                               $label="ผ่านการสำรวจแล้ว";
                                            }elseif($array[re_status]==2){
                                               $status="#F78234";
                                               $label="ชำระค่าธรรมเนียมแล้ว";
                                            }elseif($array[re_status]==3){
                                               $status="#99cc00";
                                               $label="บันทึกการปฎิบัติงานแล้ว";
                                            }elseif($array[re_status]==4){
                                               $status="#16DD87";
                                               $label="ผ่านการตรวจสอบมาตรฐาน";
                                            }elseif($array[re_status]==5){
                                               $status="#751C90";
                                               $label="ไม่ผ่านการตรวจสอบมาตรฐาน";
                                            }elseif($array[re_status]==6){
                                               $status="#2E9AFE";
                                               $label="เสร็จสิ้น";
                                            }elseif($array[re_status]==9){
                                               $status="#d9534f";
                                               $label="ไม่ผ่านการสำรวจ";
                                            }
                            ?>	
                                    <tr>
                                        <td class="text-center"><?=$page?></td>
                                            <td class=" text-center"><?=$array[re_id]?></td>
                                            <td class=" text-center"><?= Dateim($array[re_date]);?></td>
                                            <td class=" text-center"><?=$want?></td>
                                            <td class="text-center"><?=$arraycus[cus_name]?></td>
                                            <td class="text-center"><div style="border-radius:10px; background-color: <?=$status?>; color: white;"><?=$label?></div></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <a class="btn btn-default" href="RequestElectricity_detail.php?re_id=<?=$array[re_id]?>">ดูรายละเอียด</a>
                                                </div>
                                            </td>
                                    </tr>
                                    <?php
                                        }
                                            }else{	
                                    ?>				  
                                    <tr><td colspan="7" align="center">ไม่พบข้อมูล</td></tr>
                                    <?
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
