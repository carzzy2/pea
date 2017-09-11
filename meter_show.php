
<?php
@session_start();
include "connect_db.php";
$ses_umeid =$_SESSION[ses_userid];
$ses_umename = $_SESSION[loginid];
	if($ses_umeid <> session_id() or $ses_umename ==""){
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
    <div id="page-wrapper">
        <div class="col-sm-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">ข้อมูลประเภทมิเตอร์</h2>
                </div>
            <div class="panel-body">
            <div class="col-sm-12">
            <div class="col-sm-2">
                    <a href="meter_add.php"><input type="button" value="เพิ่มข้อมูล" class="btn  btn-success"></a>
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

            <div class="col-sm-12">
                <div class="table-responsive">
                    <?php
                        $sql_all_rows="select * from tb_meter order by me_id";
                        $result_all_rows=mysql_db_query($dbname,$sql_all_rows);
                        $rows=mysql_num_rows($result_all_rows);
                        echo $row;
                        $total_page=ceil($rows/$limit);
                        if($_GET[start]==""){ $start="1"; }else{ $start=$_GET[start]; }
                    ?>	
                    <?php
                    for($i=1;$i<=$total_page;$i++){
                            if($start==$i){
                                    echo "<a href='meter_show.php?start=".$i."&limit=".$limit."'><button class='btn btn-default '>".$i."</button></a>&nbsp;";
                            }else{
                                    echo "<a href='meter_show.php?start=".$i."&limit=".$limit."' c><button class='btn btn-default active'>".$i."</button></a>&nbsp;";
                            }

                    }
                    ?> <br><br>
                    <table width="100%" class="table table-bordered table-hover">
                        <thead>               
                            <tr>
                                <th class=" text-center" >ลำดับ</th>
                                <th class=" text-center" >รหัสมิเตอร์</th>
                                <th class=" text-center" >รายการ</th>
                                <th class=" text-center" >ราคาบริการ</th>
                                <th class=" text-center" >วัสถุประสงค์</th>
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
                                $sql="select * from tb_meter where me_id like '%".$_POST[search]."%' or me_name like '%".$_POST[search]."%'  limit $page,$limit ";
                                $result=mysql_db_query($dbname,$sql);
                                    if(mysql_num_rows($result)>0){
                                        while($array=mysql_fetch_array($result)){
                                            $n++;
                                            if ($array[me_type] == 0) {
                                                $want = "ขอติดตั้งมิเตอร์ใหม่";
                                            } elseif ($array[me_type] == 1) {
                                                $want = "ขอตัดฝากมิเตอร์โดยไม่ใช้ไฟฟ้า";
                                            } elseif ($array[me_type] == 2) {
                                                $want = "ขอต่อกลับการใช้ไฟฟ้า";
                                            } elseif ($array[me_type] == 3) {
                                                $want = "ขอเพื่มขนาดมิเตอร์/อุปกรณ์ประกอบ";
                                            } elseif ($array[me_type] == 4) {
                                                $want = "ขอเปลี่ยนประเภทมิเตอร์";
                                            } elseif ($array[me_type] == 5) {
                                                $want = "ขอหยุดซ่อมแซมเครื่องจักรประจำปี";
                                            } elseif ($array[me_type] == 6) {
                                                $want = "ขอใช้ไฟฟ้าชั่วคราวแบบเหมาจ่าย";
                                            } elseif ($array[me_type] == 7) {
                                                $want = "ขอติดตั้งไฟฟ้าชั่วคราว";
                                            } elseif ($array[me_type] == 8) {
                                                $want = "ขอตัดฝากมิเตอร์ใช้เพื่อแสงสว่างไม่ลด CT";
                                            } elseif ($array[me_type] == 9) {
                                                $want = "ขอยกเลิกเลิกการใช้ไฟฟ้า";
                                            } elseif ($array[me_type] == 10) {
                                                $want = "ขอลดขนาดมิเตอร์/อุปกรณ์ประกอบ";
                                            } elseif ($array[me_type] == 11) {
                                                $want = "ขอใช้ไฟฟ้าสาธารณะ";
                                            } elseif ($array[me_type] == 12) {
                                                $want = "ขอตัดมิเตอร์ใช้เพื่อแสงสว่างลด CT";
                                            } elseif ($array[me_type] == 13) {
                                                $want = "ขอย้ายจุดติดตั้งมิเตอร์/อุปกรณ์ประกอบ";
                                            } elseif ($array[me_type] == 14) {
                                                $want = "ขอเปลี่ยนมิเตอร์กรณีชำรุด";
                                            } elseif ($array[me_type] == 15) {
                                                $want = "ขอใช้ไฟฟ้าตู้โทรศัพท์ต่อตรง";
                                            } elseif ($array[me_type] == 16) {
                                                $want = $array[re_place_other];
                                            }
                            ?>	
                                    <tr>
                                        <td class="text-center"><?=$n?></td>
                                            <td><?=$array[me_id]?></td>
                                            <td><?=$first?><?=$array[me_name]?></td>
                                            <td class="text-right"><?= number_format($array[me_price],2)?></td>
                                            <td class="text-center"><?=$want?></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <a class="btn btn-default" href="meter_add.php?id=<?=$array[me_id]?>&mode=edit" title="แก้ไข"><i class="fa fa-pencil"> แก้ไข</i></a>
                                                    <a class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลนี้ ?')" href="meter_save.php?id=<?=$array[me_id]?>&mode=del" ><span class="glyphicon glyphicon-floppy-remove"> ลบ</span></a>
                                                </div>
                                            </td>
                                    </tr>
                                    <?php
                                                    }
                                            }else{	
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
        </div>
        </div>
    </div>
</div>
</body>

</html>
