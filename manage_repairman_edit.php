<?php require_once "header.php";?>

<?php
//insert data
if($_REQUEST['admin']=='update'){

   
    //แก้ไขข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา โดยข้อมูลที่แก้จะเปลี่ยนแปลงตาม id ของ รายการนั้น
    $sql = $conn->query("update repair_man set Rep_Name = '$_REQUEST[name]',
    Rep_Address = '$_REQUEST[address]',Rep_Tel = '$_REQUEST[tel]' where Rep_ID = '$_REQUEST[id]'")or die (mysqli_error());
    
    //function check แก้ไขข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Insert($sql,'แก้ไขข้อมูลเรียบร้อย','manage_repairman.php');
    
    
    }


?>



    <!--  wrapper -->
    <div id="wrapper">

        <?php 
			  require_once "menu_left.php";
		?>

        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <br/>
                <div class="col-lg-12">
                    <div class="panel panel-body panel-primary alert-danger"><h3><font color="#333333">ยินดีต้อนรับสู่ระบบจัดการ <?php echo $title_web;?></font></h3></div>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> แก้ไขข้อมูลช่าง

                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form name="form1" id="myform1" action="?admin=update&id=<?php echo $_REQUEST['id'];?>" method="post" enctype="multipart/form-data" onsubmit="return chk_error();">

                                    <?php 
									$sql = $conn->query("select * from repair_man where Rep_ID = '$_REQUEST[id]'")or die (mysqli_error());
									$show = $sql->fetch_assoc ();
									?>

                                    <div class="form-group col-lg-12">
                                            <label><font size="20">รายละเอียดของช่าง</font></label>
                                    </div>

									<div class="form-group col-lg-6">
                                            <label>ชื่อช่าง</label>
                                        <div class="form-group has-feedback">
                                            <input name="name" type="text" required class="form-control css-require" placeholder="กรอกชื่อช่าง"
                                            value="<?php echo $show['Rep_Name'];?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                            <label>ที่อยู่</label>
                                        <div class="form-group has-feedback">
                                            <input name="address" type="text" required class="form-control css-require" placeholder="กรอกที่อยู่" 
                                            value="<?php echo $show['Rep_Address'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                            <label>เบอร์โทรศัพท์</label>
                                        <div class="form-group has-feedback">
                                            <input name="tel" type="number" required class="form-control css-require" placeholder="กรอกเบอร์โทรศัพท์"
                                            value="<?php echo $show['Rep_Tel'];?>">
                                        </div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <hr>

									<div class="col-lg-12 form-group">
									<input name="submit" type="submit" class="btn btn-success panel-info" value="ยืนยัน">
									<input name=""  type="reset" class="btn btn-danger panel-info" value="ยกเลิก" onclick="location.href='manage_repairman.php';">

									</div>

									</form>

                                </div>

                            </div>

						
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->

                </div>

            </div>

                    </div>
                    <!--End Chat Panel Example-->
                </div>
            </div>

        </div>
        <!-- end page-wrapper -->

    </div></div>
    <!-- end wrapper -->

</body>

</html>
