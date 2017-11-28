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
                    <h2 class="panel-title">ข้อมูลเจ้าหน้าที่</h2>
                </div>
            <div class="panel-body">
            <div class="col-sm-2">
                    <a href="user_add.php"><input type="button" value="เพิ่มข้อมูล" class="btn  btn-success"></a>
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
                        $sql_all_rows="select * from tb_user order by user_id";
                        $result_all_rows=mysql_db_query($dbname,$sql_all_rows);
                        $rows=mysql_num_rows($result_all_rows);
                        echo $row;
                        $total_page=ceil($rows/$limit);
                        if($_GET[start]==""){ $start="1"; }else{ $start=$_GET[start]; }
                    ?>	
                    <?php
                    for($i=1;$i<=$total_page;$i++){
                            if($start==$i){
                                    echo "<a href='user_show.php?start=".$i."&limit=".$limit."'><button class='btn btn-default '>".$i."</button></a>&nbsp;";
                            }else{
                                    echo "<a href='user_show.php?start=".$i."&limit=".$limit."' c><button class='btn btn-default active'>".$i."</button></a>&nbsp;";
                            }

                    }
                    ?> <br><br>
                    <table width="100%" class="table table-bordered table-hover">
                        <thead>               
                            <tr>
                                <th class=" text-center" >ลำดับ</th>
                                <th class=" text-center" >รหัสเจ้าหน้าที่</th>
                                <th class=" text-center" >ชื่อ-นามสกุล</th>
                                <th class=" text-center" >ที่อยู่</th>
                                <th class=" text-center" >เบอร์โทรศัพท์</th>
                                <th class=" text-center" >ตำแหน่ง</th>
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
                                $sql="select * from tb_user where user_id like '%".$_POST[search]."%' or user_name like '%".$_POST[search]."%' or user_last like '%".$_POST[search]."%' limit $page,$limit ";
                                $result=mysql_db_query($dbname,$sql);
                                    if(mysql_num_rows($result)>0){
                                        while($array=mysql_fetch_array($result)){
                                            $n++;
                                            if($array[user_first]==0){
                                                $first="นาย";
                                            }elseif($array[user_first]==1){
                                                $first="นาง";
                                            }else{
                                               $first="นางสาว"; 
                                            }
                                            if($array[user_pos]==0){
                                                $stat="ผู้ดูแลระบบ";
                                            }else{
                                               $stat="เจ้าหน้าที่"; 
                                            }
                            ?>	
                                    <tr>
                                        <td class="text-center"><?=$n?></td>
                                            <td><?=$array[user_id]?></td>
                                            <td><?=$first?><?=$array[user_name]?> <?=$array[user_last]?></td>
                                            <td width="250"><?=$array[user_add]?></td>
                                            <td class="text-center"><?=$array[user_tel]?></td>
                                            <td class="text-center"><?=$stat?></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <a class="btn btn-default" href="user_add.php?id=<?=$array[user_id]?>&mode=edit" title="แก้ไข"><i class="fa fa-pencil"> แก้ไข</i></a>
                                                    <a class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลนี้ ?')" href="user_save.php?id=<?=$array[user_id]?>&mode=del" ><span class="glyphicon glyphicon-floppy-remove"> ลบ</span></a>
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
