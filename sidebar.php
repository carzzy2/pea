<?php
if($user[user_pos]==0){
?>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       
                        <li>
                            <a href="#"><i class="hidden-xs showopacity glyphicon glyphicon-user">&nbsp;</i>ข้อมูลพื้นฐาน<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="user_show.php" >ข้อมูลเจ้าหน้าที่</a></li>
                                <li><a href="customer_show" >ข้อมูลผู้ใช้บริการ</a></li>
                                <li><a href="meter_show" >ข้อมูลประเภทมิเตอร์</a></li>
                            </ul>
                            <li>
                            <a href="#"><i class="hidden-xs showopacity glyphicon glyphicon-folder-open">&nbsp;</i>รายงาน<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="#.php" >คำร้องทั่วไป</a></li>
                                <li><a href="#.php" >บันทึกคำร้องทั่วไป</a></li>
                                <li><a href="#.php" >คำร้องขอใช้ไฟฟ้า</a></li>
                                <li><a href="#" >สำรวจสถานะหน้างาน</a></li>
                            </ul>
                        </li>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
<?php }else{ ?>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       
                        <li>
                            <a href="#"><i class="hidden-xs showopacity glyphicon glyphicon-user">&nbsp;</i>ข้อมูลพื้นฐาน<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="customer_show" >ข้อมูลผู้ใช้บริการ</a></li>
                                <li><a href="meter_show" >ข้อมูลประเภทมิเตอร์</a></li>
                            </ul>
                        </li>

                        <li><a href="requestGeneral_show.php"><i class="hidden-xs showopacity glyphicon glyphicon-file">&nbsp;</i>คำร้องทั่วไป</a></li>
                        <li><a href="StatusGeneral.php"><i class="hidden-xs showopacity glyphicon glyphicon-ok-circle">&nbsp;</i>บันทึกขอคืนเงิน</a></li>
                        <li><a href="RequestElectricity_show.php"><i class="hidden-xs showopacity glyphicon glyphicon-random">&nbsp;</i>คำร้องขอใช้ไฟฟ้า</a></li>
                        <li><a href="StatusElectricity.php"><i class="hidden-xs showopacity glyphicon glyphicon-zoom-in">&nbsp;</i>สำรวจสถานะหน้างาน</a></li>
                        <li><a href="fee_show.php"><i class="hidden-xs showopacity glyphicon glyphicon-usd">&nbsp;</i>รับชำระค่าธรรมเนียม</a></li>
                        <li><a href="work_show.php"><i class="hidden-xs showopacity glyphicon glyphicon-list-alt">&nbsp;</i>บันทึกการปฎิบัติงาน</a></li>
                        <li><a href="investigate_show.php"><i class="hidden-xs showopacity glyphicon glyphicon-eye-open">&nbsp;</i>ตรวจสอบมาตรฐาน</a></li>
                        <li>
                            <a href="#"><i class="hidden-xs showopacity glyphicon glyphicon-folder-open">&nbsp;</i>รายงาน<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="#.php" >คำร้องทั่วไป</a></li>
                                <li><a href="#.php" >อนุมัติคำร้องทั่วไป</a></li>
                                <li><a href="#.php" >คำร้องขอใช้ไฟฟ้า</a></li>
                                <li><a href="#" >สำรวจสถานะหน้างาน</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
<?php } ?>
        </nav>
        
