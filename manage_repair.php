<?php require_once "header.php";?>

<?php


//delete data
if($_REQUEST['admin']=='delete'){
//ลบข้อมูลใน table ที่กำหนด ตาม id ของรายการนั้น
$sql = $conn->query("delete from orders where Ord_ID = '$_REQUEST[id]'")or die (mysqli_error());

//function delete ข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Delete($sql,'ลบข้อมูลเรียบร้อย');
}

//update status data modal
if($_REQUEST['admin']=='status'){

    //แก้ไขข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา โดยข้อมูลที่แก้จะเปลี่ยนแปลงตาม id ของ รายการนั้น
    $sql = $conn->query("update orders set Ord_RepairStatus = '$_REQUEST[modalStatus]',Ord_RepairPerson = '$_REQUEST[modalRepairPerson]',Ord_RepairPrice = '$_REQUEST[modelRepairPrice]' where Ord_ID = '$_REQUEST[id]'")or die (mysqli_error());
    
    //function check แก้ไขข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Update($sql,'อัพเดทข้อมูลเรียบร้อย');
    
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
							<!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> ตารางแสดงข้อมูลสินค้าทั้งหมด



                        </div>
						<div class="col-lg-4 form-group panel-body panel-primary sidebar-search">

						<form autocomplete="off" class="input-group custom-search-form">

	<input name="txt_search" type="text" id="course" size="50" class="form-control" placeholder="ค้นหาข้อมูลกรุณากรอกเลขที่ใบรับ" required="required" /><span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>

</form>

</div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">

									<div class="panel"><a href="manage_repair_add.php"><input name="" type="button" class="btn btn-success" value="เพิ่มรายการการซ่อม"></a></div>

                                        <table class="table table-striped table-bordered table-hover" id="table_example2">
                                            <thead>
                                                <tr>
                                                    <th width="5%"><div align="center">เลขที่ใบรับ</div></th>
                                                    <th width="auto"><div align="center">ชื่อ สกุล</div></th>
                                                    <th width="auto"><div align="center">โทรศัพท์</div></th>
                                                    <th width="auto"><div align="center">อุปกรณ์</div></th>
                                                    <th width="auto"><div align="center">วันที่รับซ่อม</div></th>
                                                    <th width="auto"><div align="center">วันนัดรับ</div></th>
													<th width="auto"><div align="center">ผู้ปฏิบัติงาน</div></th>
                                                    <th width="auto"><div align="center">สถานะการซ่อม</div></th>
                                                    <th width="auto"><div align="center">จัดการ</div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
				<?php
				if(!$_REQUEST['txt_search']){

			//โค๊ดแบ่งหน้า
			$perpage = 10;
			if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
			$start = ($page - 1) * $perpage;

//แสดงข้อมูลตามเงื่อนไข และ มีการแบ่งหน้ารายการ
$sql = $conn->query("select * from orders order by Ord_ID DESC limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกแสดงเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from orders order by Ord_ID DESC")or die (mysqli_error());
$total_record = $sql2->num_rows;
$total_page = ceil($total_record / $perpage);


		}
		else {

		//โค๊ดแบ่งหน้า
			$perpage = 10;
			if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
			$start = ($page - 1) * $perpage;

//ค้นหาข้อมูลตามเงื่อนไข และ มีการแบ่งหน้ารายการ
$sql = $conn->query("select * from  orders  where Ord_Number like '%$_REQUEST[txt_search]%' order by Ord_ID desc limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกค้นหาเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from  orders  where Ord_Number like '%$_REQUEST[txt_search]%' order by Ord_ID desc")or die (mysqli_error());
$total_record = $sql2->num_rows;
$total_page = ceil($total_record / $perpage);
		}

  $i = 1;

  while ($show= $sql->fetch_assoc()) {
      

     if($show['Ord_RepairStatus']==0){$status =  '<span class=text-info>แจ้งซ่อม</span>';}
else if($show['Ord_RepairStatus']==1){$status =  '<span class=text-info>กำลังดำเนินการ</span>';}
else if($show['Ord_RepairStatus']==2){$status =  '<span class=text-info>รออะไหล่</span>';}
else if($show['Ord_RepairStatus']==3){$status =  '<span class=text-success>ซ่อมสำเร็จ</span>';}
else if($show['Ord_RepairStatus']==4){$status =  '<span class=text-danger>ซ่อมไม่สำเร็จ</span>';}
else if($show['Ord_RepairStatus']==5){$status =  '<span class=text-danger>ยกเลิกการซ่อม</span>';}
else if($show['Ord_RepairStatus']==6){$status =  '<span class=text-success>ชำระเงิน</span>';}
else if($show['Ord_RepairStatus']==7){$status =  '<span class=text-success>ส่งมอบให้ลูกค้าเรียบร้อยแล้ว</span>';}

?>
                  <tr>
                  <td><div align="center"><?php echo $show['Ord_Number'];?></div></td>
                  <td><div align="center"><?php echo $show['Ord_CustomerName'];?></div></td>
                  <td><div align="center"><?php echo $show['Ord_CustomerTel'];?></div></td>
                  <td><div align="center"><?php echo $show['Ord_RepairModel'];?></div></td>
                  <td><div align="center"><?php echo $show['Ord_RepairDate'];?></div></td>
                  <td><div align="center"><?php echo $show['Ord_RepairSuccess'];?></div></td>
                  <td><div align="center"><?php echo $show['Ord_RepairPerson'];?></div></td>
                  <td><div align="center"><?php echo $status;?></div></td>
                  <td><div align="center">
                  <a href="print_order.php?id=<?php echo $show['Ord_ID'];?>&status=localhost/project-nawa/manage_repair_status.php?id=<?php echo $show['Ord_ID'];?>" target="_blank"><input name="" type="button" class="btn btn-dark" value="พิมพ์ใบรับซ่อม"></a>&nbsp;
                  <a href="#order<?php echo $show['Ord_ID'];?>" data-toggle="modal"><input name="" type="button" class="btn btn-warning" value="จัดการสถานะการซ่อม"></a>&nbsp;
                  <a href="manage_repair_edit.php?id=<?php echo $show['Ord_ID'];?>"><input name="" type="button" class="btn btn-primary" value="แก้ไขข้อมูลงานซ่อม"></a>&nbsp;
                  <a href="manage_repair_status.php?id=<?php echo $show['Ord_ID'];?>"><input name="" type="button" class="btn btn-info" value="รายละเอียดการซ่อม"></a>&nbsp;
                  <a href="?admin=delete&id=<?php echo $show['Ord_ID'];?>"><input name="" type="button" class="btn btn-danger" value="ลบข้อมูลงานซ่อม"></a>
                  </div></td>
                  </tr>

                    <!-- Modal -->
                    <div id="order<?php echo $show['Ord_ID'];?>" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="alert alert-success" id="exampleModalLabel" data-toggle="modal">ปรับปรุงสถานะการซ่อมเลขที่ใบรับ <?php echo $show['Ord_Number'];?></h2>
                                </div>
                                <div class="modal-body">
                                <form id="myform1" method="post" action="?admin=status&id=<?php echo $show['Ord_ID'];?>">
                                <?php 
                                $sql2 = $conn->query("select * from orders where Ord_ID = '$show[Ord_ID]'");
                                $show2 = $sql2->fetch_assoc();
                                ?>
                                 <div class="form-group">
                                    <lable>สถานะการซ่อม:<lable>
                                    <select name="modalStatus" class="form-control">
                                    <option value="0"<?php if($show2['Ord_Status']==0){echo 'selected';}?>>แจ้งซ่อม</option>
                                    <option value="1"<?php if($show2['Ord_Status']==1){echo 'selected';}?>>กำลังดำเนินการ</option>
                                    <option value="2"<?php if($show2['Ord_Status']==2){echo 'selected';}?>>รออะไหล่</option>
                                    <option value="3"<?php if($show2['Ord_Status']==3){echo 'selected';}?>>ซ่อมสำเร็จ</option>
                                    <option value="4"<?php if($show2['Ord_Status']==4){echo 'selected';}?>>ซ่อมไม่สำเร็จ</option>
                                    <option value="5"<?php if($show2['Ord_Status']==5){echo 'selected';}?>>ยกเลิกการซ่อม</option>
                                    <option value="6"<?php if($show2['Ord_Status']==6){echo 'selected';}?>>ชำระเงิน</option>
                                    <option value="7"<?php if($show2['Ord_Status']==7){echo 'selected';}?>>ส่งมอบให้ลูกค้าเรียบร้อยแล้ว</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <lable>ผู้ปฏิบัติงาน:<lable>
                                    <input type="text" name="modalRepairPerson" class="form-control" value="<?php echo $show['Ord_RepairPerson'];?>">
                                </div>
                                <div class="form-group">
                                    <lable>ค่าใช้จ่าย:<lable>
                                    <input type="text" name="modelRepairPrice" class="form-control" value="<?php echo $show['Ord_RepairPrice'];?>">
                                </div>
                                <div class="clear"></div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- endModal -->






				  <?php }?>

                  <!-- ส่วนของการแสดงเลขแบ่งหน้า ถ้าไม่พบข้อมูลเลยจะขึ้นว่า Data Not Found แต่ถ้ามีข้อมูลจะขึ้นเลขแบ่งหน้า-->
                  <tr>
                    <td colspan="12"><div align="center"><?php if($sql->num_rows==0){Chk_Row($sql);}else {?><nav>
 <ul class="pagination">
 <li>
 <a href="?page=1" aria-label="Previous">
 <span aria-hidden="true">&laquo;</span> </a> </li>
 <?php for($i=1;$i<=$total_page;$i++){ ?>
 <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
 <?php } ?>
 <li>
 <a href="?page=<?php echo $total_page;?>" aria-label="Next">
 <span aria-hidden="true">&raquo;</span> </a> </li>
 </ul>
 
 </nav><?php } ?></div></td>
                    </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->



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
