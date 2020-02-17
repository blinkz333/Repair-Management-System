<?php require_once "header.php";?>

<?php
//insert data
if($_REQUEST['admin']=='insert'){
$MemIdCheck = date('dmyHis'); 
//check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถเพิ่มข้อมูลได้
$sql = $conn->query("select * from orders where Ord_Number = '$MemIdCheck'")or die (mysqli_error());

if($sql->num_rows>0){

//function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Duplicate ($sql);

}
else {

$orderNumber = date('dmyHis'); 
$detail = nl2br($_REQUEST['description']);

//เพิ่มข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา
$sql = $conn->query("insert orders set Ord_Number = '$orderNumber',Ord_CustomerName = '$_REQUEST[name]',
Ord_CustomerTel = '$_REQUEST[phone]',Ord_CustomerAddress = '$_REQUEST[address]',Ord_CustomerProvince = '$_REQUEST[province]',
Ord_CustomerAddressCode = '$_REQUEST[addressCode]',Ord_RepairModel = '$_REQUEST[model]',Ord_RepairModelID = '$_REQUEST[modelId]',
Ord_RepairDescription = '$detail',Ord_RepairDate = '$_REQUEST[repairDate]',Ord_RepairSuccess = '$_REQUEST[repairSuccess]',
Ord_RepairPrice = '$_REQUEST[repairePrice]',Ord_RepairRemark = '$_REQUEST[repaireRemark]',Ord_RepairPerson = '$_REQUEST[repairPerson]', Ord_RepairStatus ='0'");


//function check เพิ่มข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Insert($sql,'เพิ่มข้อมูลเรียบร้อย','manage_repair.php');
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
                            <i class="fa fa-edit fa-fw"></i> เพิ่มข้อมูลการซ่อม

                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form name="form1" id="myform1" action="?admin=insert" method="post" enctype="multipart/form-data" onsubmit="return chk_error();">

                                    <div class="form-group col-lg-12">
                                            <label><font size="20">รายละเอียดของลูกค้า</font></label>
                                    </div>

									<div class="form-group col-lg-6">
                                            <label>ชื่อนามสกุล</label>
                                        <div class="form-group has-feedback">
                                            <input name="name" type="text" required class="form-control css-require" placeholder="กรอกชื่อและนามสกุล">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                            <label>เบอร์โทรศัพท์</label>
                                        <div class="form-group has-feedback">
                                            <input name="phone" type="number" required class="form-control css-require" placeholder="กรอกเบอร์โทรศัพท์">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                            <label>ที่อยู่</label>
                                        <div class="form-group has-feedback">
                                            <input name="address" type="text" required class="form-control css-require" placeholder="กรอกที่อยู่">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                            <label>จังหวัด</label>
                                        <div class="form-group has-feedback">
                                            <input name="province" type="text" required class="form-control css-require" placeholder="กรอกจังหวัด">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                            <label>รหัสไปรษณีย์</label>
                                        <div class="form-group has-feedback">
                                            <input name="addressCode" type="number" required class="form-control css-require" placeholder="กรอกรหัสไปรษณีย์">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                            <label><font size="20">รายละเอียดการซ่อม</font></label>
                                    </div>

                                    <div class="form-group col-lg-6">
                                            <label>อุปกรณ์</label>
                                        <div class="form-group has-feedback">
                                            <input name="model" type="text" required class="form-control css-require" placeholder="กรอกชื่อสิ่งของที่นำมาซ่อม เช่น คอมพิวเตอร์">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                            <label>หมายเลขเครื่อง/เลขทะเบียน</label>
                                        <div class="form-group has-feedback">
                                            <input name="modelId" type="text" required class="form-control css-require" placeholder="กรอกรหัสประจำตัวของเครื่องซ่อม">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                    <label>รายละเอียดการซ่อม/ปัญหา</label>
                                    
                                    <div class="form-group has-feedback">
                                    <textarea name="description" required class="form-control css-require" rows="7" placeholder="กรอกรายละเอียดการซ่อม/ปัญหา"></textarea>
                                    </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                            <label>วันที่รับซ่อม</label>
                                        <div class="form-group has-feedback">
                                            <input name="repairDate" type="date" required class="form-control css-require">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                            <label>วันที่นัดรับ</label>
                                        <div class="form-group has-feedback">
                                            <input name="repairSuccess" type="date" required class="form-control css-require">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                            <label>ประเมินราคา</label>
                                        <div class="form-group has-feedback">
                                            <input name="repairePrice" type="number" required class="form-control css-require" placeholder="กรอกราคาที่ประเมิณ">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                            <label>ช่างที่รับผิดชอบ</label>
                                        <div class="form-group has-feedback">
                                            <input name="repairPerson" type="text" required class="form-control css-require" placeholder="กรอกชื่อช่างที่รับผิดชอบ">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                            <label>หมายเหตุ</label>
                                        <div class="form-group has-feedback">
                                            <input name="repaireRemark" type="text" required class="form-control css-require" placeholder="กรอกหมายเหตุ">
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <hr>

									<div class="col-lg-12 form-group">
									<input name="submit" type="submit" class="btn btn-success panel-info" value="ยืนยัน">
									<input name=""  type="reset" class="btn btn-danger panel-info" value="ยกเลิก" onclick="location.href='manage_repair.php';">

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
