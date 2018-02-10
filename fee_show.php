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
    <div id="page-wrapper">
        <div class="col-sm-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">รับชำระค่าธรรมเนียม</h2>
                </div>
            <div class="panel-body">
                    <div class="col-sm-3">  
                        <div class="btn-group">
                            <a href="fee_add2.php" class="btn  btn-success">คำร้องทั่วไป</a>
                            <a href="fee_add.php" class="btn  btn-warning">คำร้องขอใช้ไฟฟ้า</a>
                       </div>
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
                    function Dateim($mydate) {
                        $d = split("-", $mydate);
                        $mydate = $d[2] . "/" . $d[1] . "/" . ($d[0] + 543);
                        return "$mydate";
                    }
                        $sql_all_rows="select * from tb_fee order by fee_id";
                        $result_all_rows=mysql_db_query($dbname,$sql_all_rows);
                        $rows=mysql_num_rows($result_all_rows);
                        echo $row;
                        $total_page=ceil($rows/$limit);
                        if($_GET[start]==""){
                            $start="1"; 
                            
                        }else{ 
                            $start=$_GET[start]; 
                            
                        }
                    ?>	
                    <?php
                    for($i=1;$i<=$total_page;$i++){
                            if($start==$i){
                                    echo "<a href='fee_show.php?start=".$i."&limit=".$limit."'><button class='btn btn-default '>".$i."</button></a>&nbsp;";
                            }else{
                                    echo "<a href='fee_show.php?start=".$i."&limit=".$limit."' c><button class='btn btn-default active'>".$i."</button></a>&nbsp;";
                            }

                    }
                    ?> 
                    <br><br>
                    <table width="100%" class="table table-bordered table-hover">
                        <thead>               
                            <tr>
                                <th class=" text-center" >ลำดับ</th>
                                <th class=" text-center" >รหัสชำระเงิน</th>
                                <th class=" text-center" >วันที่ชำระ</th>
                                <th class=" text-center" >ประเภท</th>
                                <th class=" text-center" >รหัส</th>
                                <th class=" text-center" >รายการ</th>
                                <th class=" text-center" >จำนวนเงิน</th>
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
                                $sql="select * from tb_fee,tb_user where fee_id like '%".$_POST[search]."%'and tb_fee.user_id=tb_user.user_id limit $page,$limit ";
                                $result=mysql_db_query($dbname,$sql);
                                    if(mysql_num_rows($result)>0){
                                        while($array=mysql_fetch_array($result)){
                                            echo $array[re_want_type];
                                            $n++;
                                            if($array[re_id]!=""){
                                                $sql2="select * from tb_electricity where re_id='$array[re_id]' ";
                                                $result2=mysql_db_query($dbname,$sql2);
                                                $array2=mysql_fetch_array($result2);
                                                $ss_id=$array[re_id];
                                                if ($array2[re_want_type] == 0) {
                                                    $want = "ขอติดตั้งมิเตอร์ใหม่";
                                                } elseif ($array2[re_want_type] == 1) {
                                                    $want = "ขอตัดฝากมิเตอร์โดยไม่ใช้ไฟฟ้า";
                                                } elseif ($array2[re_want_type] == 2) {
                                                    $want = "ขอต่อกลับการใช้ไฟฟ้า";
                                                } elseif ($array2[re_want_type] == 3) {
                                                    $want = "ขอเพื่มขนาดมิเตอร์/อุปกรณ์ประกอบ";
                                                } elseif ($array2[re_want_type] == 4) {
                                                    $want = "ขอเปลี่ยนประเภทมิเตอร์";
                                                } elseif ($array2[re_want_type] == 5) {
                                                    $want = "ขอหยุดซ่อมแซมเครื่องจักรประจำปี";
                                                } elseif ($array2[re_want_type] == 6) {
                                                    $want = "ขอใช้ไฟฟ้าชั่วคราวแบบเหมาจ่าย";
                                                } elseif ($array2[re_want_type] == 7) {
                                                    $want = "ขอติดตั้งไฟฟ้าชั่วคราว";
                                                } elseif ($array2[re_want_type] == 8) {
                                                    $want = "ขอตัดฝากมิเตอร์ใช้เพื่อแสงสว่างไม่ลด CT";
                                                } elseif ($array2[re_want_type] == 9) {
                                                    $want = "ขอยกเลิกเลิกการใช้ไฟฟ้า";
                                                } elseif ($array2[re_want_type] == 10) {
                                                    $want = "ชอลดขนาดมิเตอร์/อุปกรณ์ประกอบ";
                                                } elseif ($array2[re_want_type] == 11) {
                                                    $want = "ขอใช้ไฟฟ้าสาธารณะ";
                                                } elseif ($array2[re_want_type] == 12) {
                                                    $want = "ขอตัดมิเตอร์ใช้เพื่อแสงสว่างลด CT";
                                                } elseif ($array2[re_want_type] == 13) {
                                                    $want = "ขอย้ายจุดติดตั้งมิเตอร์/อุปกรณ์ประกอบ";
                                                } elseif ($array2[re_want_type] == 14) {
                                                    $want = "ขอเปลี่ยนมิเตอร์กรณีชำรุด";
                                                } elseif ($array2[re_want_type] == 15) {
                                                    $want = "ขอใช้ไฟฟ้าตู้โทรศัพท์ต่อตรง";
                                                } elseif ($array2[re_want_type] == 16) {
                                                    $want = $array2[re_place_other];
                                                }
                                                $type="คำร้องขอใช้ไฟฟ้า";
                                                $link="fee_detail";
                                            }else{
                                                $sql2="select * from tb_general where rg_id='$array[rg_id]' ";
                                                $result2=mysql_db_query($dbname,$sql2);
                                                $array2=mysql_fetch_array($result2);
                                                $ss_id=$array[rg_id];
                                                $type="คำร้องทั่วไป";
                                                $link="fee_detail2";
                                                if($array2[rg_want_type]==0){
                                                    $want="ขอรับเงินประกันการใช้ไฟฟ้าคืน";
                                                }elseif($array2[rg_want_type]==1){
                                                    $want="ขอรับเงินประกันคาปาซิเตอร์คืน";
                                                }elseif($array2[rg_want_type]==2){
                                                    $want="ขอรับเงินประกันหม้อแปลงไฟฟ้าคืน";
                                                }elseif($array2[rg_want_type]==3){
                                                    $want="ขอรับค่าขยายเขตระบบจำหน่ายไฟฟ้าคืน";
                                                }elseif($array2[rg_want_type]==4){
                                                    $want="ขอใช้บริการพิมพ์โฆษณาหลังใบแจ้งหนี้";
                                                }elseif($array2[rg_want_type]==5){
                                                    $want="ขอชำระเงินค่าไฟฟ้าโดยหักจากบัญชีเงินฝากธนาคาร";
                                                }elseif($array2[rg_want_type]==6){
                                                    $want="ขอเช่าพื้นที่โฆษณา";
                                                }elseif($array2[rg_want_type]==7){
                                                    $want="ขอเช่าพาดสายโทรนาคม";
                                                }elseif($array2[rg_want_type]==8){
                                                    $want="ขอเช่าสาย fiber optic";
                                                }elseif($array2[rg_want_type]==9){
                                                    $want="ขอเช่าที่ดิน";
                                                }elseif($array2[rg_want_type]==10){
                                                    $want="ขอซื้อที่ดิน";
                                                }elseif($array2[rg_want_type]==11){
                                                    $want="ขอใช้ไฟฟ้าที่ กฟภ. สนับสนุน";
                                                }else{
                                                   $want=$array[rg_want_other]; 
                                                }
                                                
                                            }
                            ?>	
                                    <tr>
                                        <td class="text-center"><?=$n?></td>
                                            <td><?=$array[fee_id]?></td>
                                            <td><?= Dateim($array[fee_date]); ?></td>
                                            <td class="text-center"><?=$type?></td>
                                            <td class="text-center"><?=$ss_id?></td>
                                            <td><?=$want?></td>
                                            <td class="text-right"><?= number_format($array[fee_price])?></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    
                                                    <a class="btn btn-default" href="<?=$link?>.php?fee_id=<?=$array[fee_id]?>">ดูรายละเอียด</a>
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
