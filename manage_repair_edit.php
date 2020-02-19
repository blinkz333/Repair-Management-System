<?php require_once "header.php";?>

<?php

//update data
if($_REQUEST['admin']=='update'){

    $detail = nl2br($_REQUEST['description']);
   
    //แก้ไขข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา โดยข้อมูลที่แก้จะเปลี่ยนแปลงตาม id ของ รายการนั้น
    $sql = $conn->query("update orders set Ord_CustomerName = '$_REQUEST[name]',
    Ord_CustomerTel = '$_REQUEST[phone]',Ord_CustomerAddress = '$_REQUEST[address]',Ord_CustomerProvince = '$_REQUEST[province]',
    Ord_CustomerAddressCode = '$_REQUEST[addressCode]',Ord_RepairModel = '$_REQUEST[model]',Ord_RepairModelID = '$_REQUEST[modelId]',
    Ord_RepairDescription = '$detail',Ord_RepairDate = '$_REQUEST[repairDate]',Ord_RepairSuccess = '$_REQUEST[repairSuccess]',
    Ord_RepairPrice = '$_REQUEST[repairePrice]',Ord_RepairRemark = '$_REQUEST[repaireRemark]',Ord_RepairmanID = '$_REQUEST[repairPerson]' where Ord_ID = '$_REQUEST[id]'")or die (mysqli_error());
    
    //function check แก้ไขข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Insert($sql,'แก้ไขข้อมูลเรียบร้อย','manage_repair.php');
    
    
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
                            <i class="fa fa-edit fa-fw"></i> แก้ไขข้อมูลการซ่อม

                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form name="form1" id="myform1" action="?admin=update&id=<?php echo $_REQUEST['id'];?>" method="post" enctype="multipart/form-data" onsubmit="return chk_error();">

                                    <?php 
									$sql = $conn->query("select * from orders where Ord_ID = '$_REQUEST[id]'")or die (mysqli_error());
									$show = $sql->fetch_assoc ();
									?>

                                    <div class="form-group col-lg-12">
                                            <label><font size="20">รายละเอียดของลูกค้า</font></label>
                                    </div>

									<div class="form-group col-lg-6">
                                            <label>ชื่อนามสกุล</label>
                                        <div class="form-group has-feedback">
                                            <input name="name" type="text" required class="form-control css-require" placeholder="กรอกชื่อและนามสกุล" value="<?php echo $show['Ord_CustomerName'];?>"> 
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                            <label>เบอร์โทรศัพท์</label>
                                        <div class="form-group has-feedback">
                                            <input name="phone" type="text" required class="form-control css-require" placeholder="กรอกเบอร์โทรศัพท์" value="<?php echo $show['Ord_CustomerTel'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                            <label>ที่อยู่</label>
                                        <div class="form-group has-feedback">
                                            <input name="address" type="text" required class="form-control css-require" placeholder="กรอกที่อยู่" value="<?php echo $show['Ord_CustomerAddress'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                            <label>จังหวัด</label>
                                        <div class="form-group has-feedback">
                                            <input name="province" type="text" required class="form-control css-require" placeholder="กรอกจังหวัด" value="<?php echo $show['Ord_CustomerProvince'];?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                            <label>รหัสไปรษณีย์</label>
                                        <div class="form-group has-feedback">
                                            <input name="addressCode" type="number" required class="form-control css-require" placeholder="กรอกรหัสไปรษณีย์" value="<?php echo $show['Ord_CustomerAddressCode'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                            <label><font size="20">รายละเอียดการซ่อม</font></label>
                                    </div>

                                    <div class="form-group col-lg-6">
                                            <label>อุปกรณ์</label>
                                        <div class="form-group has-feedback">
                                            <input name="model" type="text" required class="form-control css-require" placeholder="กรอกชื่อสิ่งของที่นำมาซ่อม เช่น คอมพิวเตอร์" value="<?php echo $show['Ord_RepairModel'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                            <label>หมายเลขเครื่อง/เลขทะเบียน</label>
                                        <div class="form-group has-feedback">
                                            <input name="modelId" type="text" required class="form-control css-require" placeholder="กรอกรหัสประจำตัวของเครื่องซ่อม" value="<?php echo $show['Ord_RepairModelID'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label>รายละเอียดการซ่อม/ปัญหา</label>
                                         <div class="form-group has-feedback">
                                            <textarea name="description" required class="form-control css-require" rows="7" placeholder="กรอกรายละเอียดการซ่อม/ปัญหา"><?php echo $show['Ord_RepairDescription'];?></textarea>
                                         </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                            <label>หมายเหตุ</label>
                                        <div class="form-group has-feedback">
                                            <input name="repaireRemark" type="text" required class="form-control css-require" placeholder="กรอกหมายเหตุ" value="<?php echo $show['Ord_RepairDescription'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                            <label>วันที่รับซ่อม</label>
                                        <div class="form-group has-feedback">
                                            <input name="repairDate" type="date" required class="form-control css-require" value="<?php echo $show['Ord_RepairDate'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                            <label>วันที่นัดรับ</label>
                                        <div class="form-group has-feedback">
                                            <input name="repairSuccess" type="date" required class="form-control css-require" value="<?php echo $show['Ord_RepairSuccess'];?>">
                                        </div>
                                    </div>
                                   

                                    <div class="form-group col-lg-3">
                                            <label>ประเมินราคา</label>
                                        <div class="form-group has-feedback">
                                            <input name="repairePrice" type="number" required class="form-control css-require" placeholder="กรอกราคาที่ประเมิณ" value="<?php echo $show['Ord_RepairPrice'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                            <label>ช่างที่รับผิดชอบ</label>
                                        <div class="form-group has-feedback">
                                         <select name="repairPerson" class="form-control">
                                        <?php 
									    $sql = $conn->query("select * from repair_man")or die (mysqli_error());
                                        while ($show= $sql->fetch_assoc()) {
                                            $value = $show['Rep_ID'];
                                            $text = $show['Rep_Name'];

                                            echo "<option value='$value' selected>$text</option>";
                                        }
									    ?>
                                        </select>
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
