 <?php
if($_REQUEST['logout']=='chk'){

    //ออกจากระบบ
    Logout($_SESSION['ses_admin_id'],'index.php');
}
?>

 <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">

                            <div class="user-info">
                                <div><strong><font color="white">ชื่อผู้ใช้ขณะนี้ : </font></strong><font color="white"><?php echo $_SESSION['ses_admin_user'];?></font></div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    
                    <li >
                        <a href="main.php"><i class="fa fa-dashboard fa-fw"></i>หน้าหลัก</a>
                    </li>
					
					<li>
					<a href="#"><i class="fa fa-edit fa-fw"></i> งานซ่อม<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						    <li>
                                <a href="manage_repair.php">- รายการซ่อม</a>
                            </li>
						</ul>
                    </li>

                    <li>
                    <a href="#"><i class="fa fa-save fa-fw"></i> สมาชิก<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                       
                            <li>
                                <a href="manage_product.php"> - รายชื่อสมาชิก</a>
                            </li>
                            <li>
                                <a href="manage_product.php"> - สมัครสมาชิก</a>
                            </li>
                           
                        </ul>
                    </li>
                  
                    <li>
                    <li>
                        <a href="?logout=chk"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
                    </li>


                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->