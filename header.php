<?php 
$sqluser="select *from tb_user where user_id='".$_SESSION[loginid]."'";
$reuser=mysql_db_query($dbname,$sqluser);
$user=mysql_fetch_array($reuser);
?>
<nav style="background-color:#7c4197;" class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0" >
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color: White" href="index.php">PROVINCIAL ELECTRICITY AUTHORITY</a>
            </div>
            <!-- /.navbar-header -->
            
            <ul class="nav navbar-top-links navbar-right" >
                 <li class="dropdown">
                     <a style="color: White" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        คุณ<?=$user[user_name]?> <?=$user[user_last]?>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="logout.php" onclick="return confirm('คุณต้องการออกจากระบบ ใช่หรือไม่ ?')"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                
              
            </ul>
            <!-- /.navbar-top-links -->

