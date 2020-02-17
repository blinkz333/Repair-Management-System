<?php require_once "header.php";?>

<?php
//insert data
if($_REQUEST['admin']=='insert'){
//check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถเพิ่มข้อมูลได้
$sql = $conn->query("select * from member where Mem_User = '$_REQUEST[username]'")or die (mysqli_error());

if($sql->num_rows>0){

//function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Duplicate ($sql);

}
else {


//เพิ่มข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา
$sql = $conn->query("insert member set Mem_User = '$_REQUEST[username]',Mem_Pass = '$_REQUEST[password]',
Mem_Name = '$_REQUEST[name]',Mem_Email = '$_REQUEST[email]',Mem_Tel = '$_REQUEST[tel]',
Mem_Address = '$_REQUEST[address]',Mem_Date = now(),Mem_Permission = '1',
Mem_Status = '1'");


//function check เพิ่มข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Insert($sql,'เพิ่มข้อมูลเรียบร้อย','manage_admin.php');
}


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
                            <i class="fa fa-user fa-fw"></i> เพิ่มข้อมูลผู้ดูแลระบบ

                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form name="form1" id="myform1" action="?admin=insert" method="post" enctype="multipart/form-data" onsubmit="return chk_error();">

                                    <div class="form-group col-lg-12">
                                            <label><font size="20">รายละเอียดของผู้ดูแลระบบ</font></label>
                                    </div>

									<div class="form-group col-lg-6">
                                            <label>ชื่อผู้ใช้</label>
                                        <div class="form-group has-feedback">
                                            <input name="username" type="text" required class="form-control css-require" placeholder="กรอกชื่อผู้ใช้">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                            <label>รหัสผ่าน</label>
                                        <div class="form-group has-feedback">
                                            <input name="password" type="password" required class="form-control css-require" placeholder="กรอกรหัสผ่าน">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                            <label>ชื่อและนามสกุล</label>
                                        <div class="form-group has-feedback">
                                            <input name="name" type="text" required class="form-control css-require" placeholder="กรอกชื่อและนามสกุล">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                            <label>อีเมลล์</label>
                                        <div class="form-group has-feedback">
                                            <input name="email" type="text" required class="form-control css-require" placeholder="กรอกอีเมลล์">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                            <label>เบอร์โทรศัพท์</label>
                                        <div class="form-group has-feedback">
                                            <input name="tel" type="number" required class="form-control css-require" placeholder="กรอกเบอร์โทรศัพท์">
                                        </div>
                                    </div>


                                    <div class="form-group col-lg-6">
                                            <label>ที่อยู่</label>
                                        <div class="form-group has-feedback">
                                            <input name="address" type="text" required class="form-control css-require" placeholder="กรอกที่อยู่่">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="clearfix"></div>
                                    <hr>

									<div class="col-lg-12 form-group">
									<input name="submit" type="submit" class="btn btn-success panel-info" value="ยืนยัน">
									<input name=""  type="reset" class="btn btn-danger panel-info" value="ยกเลิก" onclick="location.href='manage_admin.php';">

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
