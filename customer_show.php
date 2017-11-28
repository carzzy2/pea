
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
                    <h2 class="panel-title">ข้อมูลผู้ใช้บริการ</h2>
                </div>
            <div class="panel-body">
            <div class="col-sm-12">
            <div class="col-sm-2">
                    <a href="customer_add.php"><input type="button" value="เพิ่มข้อมูล" class="btn  btn-success"></a>
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
                        $sql_all_rows="select * from tb_customer order by cus_id";
                        $result_all_rows=mysql_db_query($dbname,$sql_all_rows);
                        $rows=mysql_num_rows($result_all_rows);
                        echo $row;
                        $total_page=ceil($rows/$limit);
                        if($_GET[start]==""){ $start="1"; }else{ $start=$_GET[start]; }
                    ?>	
                    <?php
                    for($i=1;$i<=$total_page;$i++){
                            if($start==$i){
                                    echo "<a href='customer_show.php?start=".$i."&limit=".$limit."'><button class='btn btn-default '>".$i."</button></a>&nbsp;";
                            }else{
                                    echo "<a href='customer_show.php?start=".$i."&limit=".$limit."' c><button class='btn btn-default active'>".$i."</button></a>&nbsp;";
                            }

                    }
                    ?> <br><br>
                    <table width="100%" class="table table-bordered table-hover">
                        <thead>               
                            <tr>
                                <th class=" text-center" >ลำดับ</th>
                                <th class=" text-center" >รหัสประชาชน</th>
                                <th class=" text-center" >ชื่อ-นามสกุล</th>
                                <th class=" text-center" >ที่อยู่</th>
                                <th class=" text-center" >เบอร์โทรศัพท์</th>
                                <th class=" text-center" >Fax</th>
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
                                $sql="select * from tb_customer where cus_id like '%".$_POST[search]."%' or cus_name like '%".$_POST[search]."%'  limit $page,$limit ";
                                $result=mysql_db_query($dbname,$sql);
                                    if(mysql_num_rows($result)>0){
                                        while($array=mysql_fetch_array($result)){
                                            $n++;
                                            if($array[cus_first]==0){
                                                $first="นาย";
                                            }elseif($array[cus_first]==1){
                                                $first="นาง";
                                            }else{
                                               $first="นางสาว"; 
                                            }
                            ?>	
                                    <tr>
                                        <td class="text-center"><?=$n?></td>
                                            <td><?=$array[cus_id]?></td>
                                            <td><?=$first?><?=$array[cus_name]?></td>
                                            <td width="300px">บ้านเลขที่ <?=$array[cus_number]?> หมู่บ้าน/อาคาร <?=$array[cus_village]?> ซ. <?=$array[cus_alleyway]?> ถ. <?=$array[cus_road]?> ม. <?=$array[cus_vilno]?> ต. <?=$array[cus_district]?> อ. <?=$array[cus_canton]?> จ. <?=$array[cus_province]?> <?=$array[cus_post]?> 
                                            </td>
                                            <td class="text-center"><?=$array[cus_tel]?></td>
                                            <td class="text-center"><?=$array[cus_fax]?></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <a class="btn btn-default" href="customer_add.php?id=<?=$array[cus_id]?>&mode=edit" title="แก้ไข"><i class="fa fa-pencil"> แก้ไข</i></a>
                                                    <a class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลนี้ ?')" href="customer_save.php?id=<?=$array[cus_id]?>&mode=del" ><span class="glyphicon glyphicon-floppy-remove"> ลบ</span></a>
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
