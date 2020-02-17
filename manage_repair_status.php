<?php require_once "header.php";?>

<?php 
$sql = $conn->query("select * from orders where Ord_ID = '$_REQUEST[id]'")or die (mysqli_error());
$show = $sql->fetch_assoc ();

if($show['Ord_RepairStatus']==0){$status =  '<span class=text-info>แจ้งซ่อม</span>';}
else if($show['Ord_RepairStatus']==1){$status =  '<span class=text-info>กำลังดำเนินการ</span>';}
else if($show['Ord_RepairStatus']==2){$status =  '<span class=text-info>รออะไหล่</span>';}
else if($show['Ord_RepairStatus']==3){$status =  '<span class=text-success>ซ่อมสำเร็จ</span>';}
else if($show['Ord_RepairStatus']==4){$status =  '<span class=text-danger>ซ่อมไม่สำเร็จ</span>';}
else if($show['Ord_RepairStatus']==5){$status =  '<span class=text-danger>ยกเลิกการซ่อม</span>';}
else if($show['Ord_RepairStatus']==6){$status =  '<span class=text-success>ชำระเงิน</span>';}
else if($show['Ord_RepairStatus']==7){$status =  '<span class=text-success>ส่งมอบให้ลูกค้าเรียบร้อยแล้ว</span>';}
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
                            <i class="fa fa-file fa-fw"></i> รายละเอียดการซ่อม

                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form name="form1" id="myform1" action="?admin=insert" method="post" enctype="multipart/form-data" onsubmit="return chk_error();">

                                    <div class="form-group col-lg-12">
                                            <label><font size="20"><u>รายละเอียดของลูกค้า</u></font></label>
                                    </div>

									<div class="form-group col-lg-12 ">
                                            <label class="fontLabel"><i class="fa fa-user fa-fw"></i> ชื่อและนามสกุล : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_CustomerName']?></label>
                                    </div>
                                    
                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-location-arrow fa-fw"></i> ที่อยู่ : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_CustomerAddress']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-phone fa-fw"></i> โทรศัพท์ : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_CustomerTel']?></label>
                                    </div>

                                    <br/>

                                    <div class="form-group col-lg-12">
                                            <label><font size="20"><u>รายละเอียดการซ่อม</u></font></label>
                                    </div>
                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-file fa-fw"></i> อุปกรณ์ : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairModel']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-laptop fa-fw"></i> หมายเลขเครื่อง/เลขทะเบียน : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairModelID']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-calendar fa-fw"></i> วันที่รับซ่อม : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairDate']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-calendar fa-fw"></i> วันนัดรับ : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairSuccess']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-money fa-fw"></i> ประเมินราคา : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairPrice']?>&nbsp;บาท</label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-wrench fa-fw"></i> รายละเอียดการซ่อม/ปัญหา  : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairDescription']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-dashboard fa-fw"></i> สถานะปัจจุบัน  : </label>&emsp;<label class="fontValue"><?php echo $status; ?></label>
                                    </div>
                                  
                                    
                                    <div class="clearfix"></div>
                                    <hr>

									<div class="col-lg-12 form-group">
									<input name=""  type="reset" class="btn btn-danger panel-info" value="กลับ" onclick="location.href='manage_repair.php';">

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
